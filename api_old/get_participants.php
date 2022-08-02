  <?php

include "db.php";
       
  $query = $conn->prepare("SELECT * FROM user WHERE user_varified='Yes'");
  $query->execute();
  $result = $query->fetchAll();

   if ($result!='') 
  {
     
       echo json_encode(array("participant_list"=>$result) );
  }
  else
  {
       echo json_encode(array( "participant_list"=>'') );
  }
?>