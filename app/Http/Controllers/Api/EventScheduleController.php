<?php

namespace AcademicDirectory\Http\Controllers\Api;

use AcademicDirectory\Domains\Events\EventScheduleRepository;
use AcademicDirectory\Domains\Events\EventsRepository;
use AcademicDirectory\Domains\Lectures\LecturesRepository;
use AcademicDirectory\Domains\Users\LectureUserRolesRepository;
use AcademicDirectory\Domains\Users\UsersLectureRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventScheduleController extends Controller
{
    private $eventsRepository;
    private $eventScheduleRepository;
    private $lecturesRepository;

    public function __construct(EventsRepository $eventsRepository, EventScheduleRepository $eventScheduleRepository, LecturesRepository $lecturesRepository)
    {
        $this->middleware('auth');
        $this->eventsRepository = $eventsRepository;
        $this->eventScheduleRepository = $eventScheduleRepository;
        $this->lecturesRepository = $lecturesRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('api/default_user/events/schedule')
            ->with('event', $this->eventsRepository->findByID($request->id));
    }

    public function schedule_day($name, $event_schedule_id, $date)
    {
        $EventScheduleDay = $this->eventScheduleRepository->findByID($event_schedule_id);
        $array_is_subscriber = $this->eventsRepository->isUserSubscriberInEvent($EventScheduleDay->event_id, auth()->id());
        $is_pending = count($array_is_subscriber) ? false : true;
        $Lectures= $this->lecturesRepository->getAllLecturesByScheduleIdAndType($event_schedule_id, 'Palestras');
        $Courses = $this->lecturesRepository->getAllLecturesByScheduleIdAndType($event_schedule_id, 'Cursos');
        return view('api/default_user/events/schedule_day')
            ->with('event_schedule', $EventScheduleDay)
            ->with('lectures', $Lectures)
            ->with('courses', $Courses)
            ->with('is_pending', $is_pending);
    }

    public function subscribe($event_schedule_id, $lecture_id, UsersLectureRepository $usersLectureRepository, LecturesRepository $lecturesRepository, LectureUserRolesRepository $lectureUserRolesRepository)
    {
        $Lecture = $lecturesRepository->findByID($lecture_id);
        $EventSchedule = $this->eventScheduleRepository->findByID($event_schedule_id);
        $event_id = $EventSchedule->event_id;
        $user_id = Auth::id();
        $LecturesSubscribed = $usersLectureRepository->getAllLecturesThatUserIsSubscriber($user_id, $EventSchedule->id);
        $conflicts = $this->getArrayOfConfirmsInTheSameHour($LecturesSubscribed, $Lecture);
        if (array_count_values($conflicts)) {
            return response()->json(['status' => 'conflict', 'conflict_ids' => $conflicts]);
        } else {
            DB::beginTransaction();
            try {
                $count = $usersLectureRepository->countUsersSubscribedInLecture($event_id, $lecture_id)->first();
                if ($count->user_count < $Lecture->max_people) {
                    $isSubscriber = $this->eventsRepository->isUserSubscriberInEvent($event_id, $user_id);
                    $is = (count($isSubscriber)) ? true : 'false';
                    $UserLectures = $usersLectureRepository->create(['user_id' => $user_id, 'lecture_id' => $lecture_id]);
                    $lectureUserRolesRepository->saveByType($UserLectures->id, 'Participante');
                    DB::commit();
                    return response()->json(['status' => true, 'message' => '', 'subs' => $is, 'lecture_id' => $lecture_id]);
                } else {
                    DB::commit();
                    return response()->json(['status' => 'maxpeople', 'message' => 'Esta palestra/curso já atingiu o número máximo', 'lecture_id' => $lecture_id]);
                }
            } catch (Exception $e) {
                DB::rollback();
                return response()->json(['status' => 'false', 'message' => '']);
            }
        }
    }

    public function unsubscribe($lecture_id, UsersLectureRepository $usersLectureRepository, LectureUserRolesRepository $lectureUserRolesRepository)
    {
        DB::beginTransaction();
        try {
            $user_id = Auth::id();
            $UserLecture = $usersLectureRepository->findByUserAndLectureId($user_id, $lecture_id)->first();
            $lectureUserRolesRepository->deleteByType($UserLecture->id, 'Participante');
            $usersLectureRepository->unsubscribe($user_id, $lecture_id);
            DB::commit();
            return response()->json(['status' => 'deleted', 'lecture_id' => $lecture_id]);
        } catch (Exception $e) {
            DB::rollback();
        }

    }

    public function lecturesSubscribed($event_schedule_id, UsersLectureRepository $usersLectureRepository, LecturesRepository $lecturesRepository)
    {
        $EventSchedule = $this->eventScheduleRepository->findByID($event_schedule_id);
        $event_id = $EventSchedule->event_id;
        $schedule_id = $EventSchedule->id;
        $CrowdedLectures = $lecturesRepository->getAllCrowdedLecturesFromEventAndDate($schedule_id);
        $LecturesSubscribed = $usersLectureRepository->getAllLecturesThatUserIsSubscriber(Auth::id(), $schedule_id);
        return response()->json(['status' => true, 'lectures_subscribed' => $LecturesSubscribed, 'crowded_lectures' => $CrowdedLectures]);
    }

    private function getArrayOfConfirmsInTheSameHour($lectures, $lecture)
    {
        $i_hour = $lecture->init_hour;
        $e_hour = $lecture->end_hour;

        $conflictLectureIds = array();
        foreach ($lectures as $index => $lec) {
            /*
             ($i_hour < $lec->init_hour && $e_hour < $lec->end_hour)
             || ($i_hour > $lec->init_hour && $e_hour > $lec->end_hour)
             || ($i_hour == $lec->init_hour && $e_hour == $lec->end_hour)
             */
            if (($i_hour <= $lec->init_hour && $e_hour >= $lec->end_hour)
                || ($i_hour >= $lec->init_hour && $e_hour <= $lec->end_hour)

            ) {
                $conflictLectureIds[] = $lec->id;
            }
        }
        return $conflictLectureIds;
    }
}
