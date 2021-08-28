<?php
class Url {
    
    const LOGIN_URL = Constant::BASE_URL."candidate/candidate/candidateLogin"; //useBASE_URL constant to complete url
    const COURSE_LAYOUT = Constant::BASE_URL."candidate/homepage/getLayout";
    const COURSE_VIDEO = Constant::BASE_URL."candidate/candidate/getCourseVideos";
    const CURRENT_AFFAIRS = Constant::BASE_URL."candidate/common/getCurrentAffairsList";
    const FORGET_URL = Constant::BASE_URL."candidate/candidate/forgotPassword";
    const SIGNUP_URL = Constant::BASE_URL."candidate/candidate/candidateSignUp";
}
?>