<?php
  include "config.php";
    if (isset($_REQUEST['delete_noteid'])) 
    { 
        $id = $_REQUEST['delete_noteid'];
        $DEL = "DELETE FROM my_note WHERE id='$id' ";
        $DEL_Q = mysql_query($DEL, $conn);
        if ($DEL_Q) 
        { 
          header('Location: my_note.php?note_delete=success');
        }
        else
        { 
          header('Location: my_note.php?note_delete=success');
       }
    }
  ?>