<?php
  function get_number($userid)
  {
    $sql = "SELECT * FROM user WHERE userid='".$userid."' ";
    $result = mysql_query($sql);
    $rr = mysql_fetch_assoc($result);
    return $rr['ucontact'];
  } 
  function get_image($userid)
  {
    $sql = "SELECT * FROM user WHERE userid='".$userid."' ";
    $result = mysql_query($sql);
    $rr = mysql_fetch_assoc($result);
    return $rr['profile_pic'];
  }
  function get_name($userid)
  {
    $sql = "SELECT * FROM user WHERE userid='".$userid."' ";
    $result = mysql_query($sql);
    $rr = mysql_fetch_assoc($result);
    return $rr['ufname'];
  }
  function get_mail($userid)
  {
    $sql = "SELECT * FROM user WHERE userid='".$userid."' ";
    $result = mysql_query($sql);
    $rr = mysql_fetch_assoc($result);
    return $rr['uemail'];
  }
  function get_rate($userid, $rem_id)
  {
    $sql = "SELECT * FROM rating WHERE userid='".$userid."' AND rem_id='".$rem_id."' ";
    $result = mysql_query($sql);
    $rr = mysql_fetch_assoc($result);
    return $rr['rate'];
  } 
  function get_user_type($userid)
  {
    $sql = "SELECT * FROM user WHERE userid='".$userid."' ";
    $result = mysql_query($sql);
    $rr = mysql_fetch_assoc($result);
    return $rr['utype'];
  } 
?>