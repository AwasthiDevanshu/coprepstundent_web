<?php
/**
 * File to keep track of Api Urls
 */
class  Url {
    
    const LOGIN_URL = Constant::BASE_URL."candidate/candidate/candidateLogin";
    const FORGET_PASS = Constant::BASE_URL."candidate/candidate/forgotPassword";
    const LAYOUT_URL = Constant::BASE_URL ."candidate/homepage/getLayout";
    const COURSE_VIDEO_LIST =  Constant::BASE_URL . 'candidate/candidate/getCourseVideos';
}