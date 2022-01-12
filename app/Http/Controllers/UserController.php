<?php

namespace App\Http\Controllers;

use App\Models\Reservations;
use App\Models\UserPlans;
use App\Models\User;
use App\Models\Routes;
use App\Models\RoutesData;
use App\Models\DisabledDays;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private $daysOfWeek = [
        1 => 'sun',
        2 => 'mon',
        3 => 'tue',
        4 => 'wed',
        5 => 'thu',
        6 => 'fri',
        7 => 'sat'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Get reservations days on calendar
     *
     * @return \Illuminate\Http\Response
     */
    public function getReservations($user = NULL, $initialDate = NULL, $endDate = NULL)
    {
        if ($user === NULL) {
            $reservations = Reservations::all();
            return $reservations;
        } else {
            $fields = [
                'user_plans.id as userPlanId',
                'reservations.id as reservationId',
                'user_id',
                'reservation_start',
                'reservation_end',
                'reservations.route_id as routeId',
                'title as route',
                'routes.start_timestamp as route_time_start',
                'routes.end_timestamp as route_time_end',
                'reservations.created_at',
                'reservations.updated_at',
                'enabled',
                'financiation',
                'business_name',
                "pending_payment",
                "date_max_payment",
                "proxim_start_timestamp",
                "proxim_end_timestamp",
                "proxim_renewal_timestamp",
                "proxim_renewal_price"
            ];
            $plan = '';
            if ($initialDate === NULL) {
                $plan = DB::table('reservations')
                    ->where('user_plans.user_id', $user)
                    ->join('user_plans', 'reservations.user_plan_id', '=', 'user_plans.id')
                    ->join('routes', 'reservations.route_id', '=', 'routes.id')
                    ->get($fields);
            } else {
                if ($endDate === NULL) {
                    $plan = DB::table('reservations')
                        ->where('user_plans.user_id', $user)
                        ->where('reservations.reservation_start', '>=', $initialDate)
                        ->join('user_plans', 'reservations.user_plan_id', '=', 'user_plans.id')
                        ->join('routes', 'reservations.route_id', '=', 'routes.id')
                        ->get($fields);
                } else {
                    $plan = DB::table('reservations')
                        ->where('user_plans.user_id', $user)
                        ->where('reservations.reservation_start', '>=', $initialDate)
                        ->where('reservations.reservation_end', '<=', $endDate)
                        ->join('user_plans', 'reservations.user_plan_id', '=', 'user_plans.id')
                        ->join('routes', 'reservations.route_id', '=', 'routes.id')
                        ->get($fields);
                }
            }
            return $plan;
        }
    }
    public function pushReservation($userId, Request $request)
    {
        if ($userId === NULL) {
            return \Response::json([
                'status' => 400,
                'message' => 'Campo userId requerido'
            ], 400);
        }
        $user = User::find($userId);
        if ($user === NULL) {
            return \Response::json([
                'status' => 400,
                'message' => 'El usuario no fue encontrado'
            ], 400);
        } else {
            // Verify if the route has available by route id
            $routeOrigin = $this->getRoutesByCode($request->route_origin_code);
            $routeEnding = $this->getRoutesByCode($request->route_end_code);

            if ($this->routeAvailabilityById($routeOrigin->id, $request->reservation_start, $request->reservation_end)) { // True = available route
                $user_plan = new UserPlans();
                $user_plan->user_id = $userId;
                $user_plan->currency_id = 2;
                $user_plan->renewal_price = $request->renewal_price;
                $user_plan->requires_invoice = 0;
                $user_plan->status = 10;
                $user_plan->created = date('Y-m-d');
                $user_plan->financiation = 0;
                $user_plan->language = $request->language;
                $user_plan->nif = $request->nif;
                $user_plan->business_name = $request->business_name;
                $user_plan->pending_payment = 0;
                $user_plan->credits_return = 0.00;
                $user_plan->company_id = 0;
                $user_plan->cancel_employee = 0;
                $user_plan->force_renovation = 0;
                $user_plan->date_canceled = date('Y-m-d');
                $user_plan->amount_confirm_canceled = 10.00;
                $user_plan->credit_confirm_canceled = 30.00;
                $user_plan->cost_center_id = 0;
                $user_plan->status_financiation = 0;
                $user_plan->start_timestamp = $routeOrigin->start_timestamp;
                $user_plan->end_timestamp = $routeOrigin->end_timestamp;

                $user_plan->save();

                DB::table('reservations')->insert([
                    'user_plan_id' => $user_plan->id,
                    'route_id' => $routeOrigin->id,
                    'reservation_start' => $request->reservation_start,
                    'reservation_end' => $request->reservation_end,
                    'route_stop_origin_id' => $routeOrigin->id,
                    'route_stop_destination_id' => $routeEnding->id,
                    'enabled' => true
                ]);
                return $request;
            } else {
                return \Response::json([
                    'status' => 400,
                    'message' => 'Ruta no disponible'
                ], 400);
            }
        }
    }
    private function getRoutesByCode($code)
    {
        $routes = Routes::all()
            ->where('invitation_code', $code);
        foreach ($routes as $r) {
            $routes = $r;
        }
        return $routes;
    }
    private function routeAvailabilityById($routeStartId, $reservationStart, $reservationEnd)
    {
        $route = RoutesData::all()
            ->where('route_id', $routeStartId)
            ->where('route_circular', 1);
        if (count($route) > 0) {
            // Calculate dayofweek in reservationStart
            $day_of_week = DB::select("SELECT DAYOFWEEK('" . $reservationStart . "') AS dia;")[0]->dia;
            $day_of_week = $this->daysOfWeek[$day_of_week];
            // Verify date available
            $dateAvailable = RoutesData::all()
                ->where('route_id', $routeStartId)
                ->where('date_init', '>=', $reservationStart) // Check if the initial reservation is greater than or equal to the availability of the route and less than the deadline
                ->where('date_finish', '>=', $reservationEnd) // Check if the initial date than available for the route selected
                ->where($day_of_week, 1);
            $calendar_id = '';
            foreach ($dateAvailable as $d) {
                $calendar_id = $d->calendar_id;
            }
            if (count($dateAvailable) > 0) { // Check if the reservations start are in disabled_days table relationate with calendar id field
                $disabledDays = DisabledDays::all()
                ->where('calendar_id', $calendar_id)
                ->where('day', '=', $reservationStart);
                if (count($disabledDays) == 0) {
                    return true;
                }
            }
        } else {
            return false;
        }
    }
    public function deleteReservation($userId)
    {
        $userPlans = UserPlans::all()
        ->where('user_id', $userId);
        $userPlansId = '';
        foreach ($userPlans as $u) {
            $userPlansId = $u->id;
            $userPlans = $u;
        }
        DB::table('reservations')
        ->where('user_plan_id', $userPlansId)
        ->delete();
        DB::table('user_plans')
        ->where('user_id', $userId)
        ->delete();

        return $userPlans;
    }
}
