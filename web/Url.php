<?php
class Url {
    
    const LOGIN_URL = Constant::BASE_URL."candidate/candidate/candidateLogin";
    const COURSE_LAYOUT = Constant::BASE_URL."candidate/homepage/getLayout";
    const COURSE_CAT = Constant::BASE_URL."course/course/getCourseCategories";
    const COURSE_NOTES = Constant::BASE_URL."course/Misc/getCourseNotesList";
    const COURSE_VIDEO = Constant::BASE_URL."candidate/candidate/getCourseVideos";
    const CURRENT_AFFAIRS = Constant::BASE_URL."candidate/common/getCurrentAffairsList";
    const FORGET_URL = Constant::BASE_URL."candidate/candidate/forgotPassword";
    const SIGNUP_URL = Constant::BASE_URL."candidate/candidate/candidateSignUp";
    const CHAT_URL = "https://chat.cprep.in/";
    const TEST_URL = Constant::BASE_URL."candidate/candidate/getCandidateTestSeries";
    const TESTLIST_URL = Constant::BASE_URL."/candidate/candidate/getCandidateTestList";
    const LOGOUT_URL = Constant::BASE_URL."/candidate/candidate/logout";
}
?>