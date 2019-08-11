package com.example.root.test.Constant;

/**
 * Created by root on 03/02/19.
 */

public class Constants {


    /** constanns*/
    public static final String realIp="http://192.168.43.241/";
    private static final String Root_Url =realIp+ "Android/v1/";
    public static final String urlLogin = Root_Url + "userLogin.php";




    /**student constant*/
    public static  final String getinfo=Root_Url+"getuserinfo.php";
    public static final String room = Root_Url + "roomsearch.php";
    public static final String fetchdoctors = Root_Url + "stufffetch.php";
    public static final String facultydata = Root_Url + "facultydata.php";
    public   static  final  String schadual=Root_Url+"schadual.php";
    public  static  final  String courses=Root_Url+"courses.php";
    public static  final String  notifi=Root_Url+"load.php";
    public static   final String department=Root_Url+"departments.php";
    public static  final String updatepass=Root_Url+"updatestudentpass.php";




    /**staff constants**/
    public  static  final  String schadul_staff=Root_Url+"stuffSchadule.php";
    public static final String worker=Root_Url+"workerfetch.php";
    public  static  final  String staffinfo=Root_Url+"getstaffinfo.php";
    public  static  final  String notifidoc=Root_Url+"noifgidoctor.php";
    public  static  final  String departpost=Root_Url+"annoncetodepartment.php";
    public static  final String staffpass=Root_Url+"teashinstaffpass.php";
    public static  final String studentpost=Root_Url+"studentpost.php";



    /*****Youthcare**/
    public  static  final String youthcareannonce=Root_Url+"Youthcarepost.php";
    public static final  String youthcarepass=Root_Url+"youthcarepass.php";

}
