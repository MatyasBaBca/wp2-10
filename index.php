<!DOCTYPE html>
<html>
<head>
  <title></title>
  <style>
      .completed{
        background-color: green;
         display: inline;
      }
      .incompleted{
        background-color: red;
        display: inline;
      }
  </style>
</head>
<body>
<?php 
$classes = array(
  '2C' => array(
      'projects' => array(
        "wp2-01",
        "wp2-02",
        "wp2-03",
        "wp2-04",
        "wp2-05",
        "wp2-06",
        "wp2-07",
        "wp2-08",
        "wp2-09",
        "wp2-10",
      ),
    'user' => array(
    "jdoe999",
    "MatyasBaBca"
    )
  ),
  '3C' => array(
      'projects' => array(
      "wp5-01",
    ),
    'user' => array(
      'kristian33'
    )
  )
);
$userCompleted = 0;
//print all projects
foreach ($classes as $class => $classvalue){
  $final .= "<h1> $class </h1>";
  foreach ($classvalue['user'] as $user){
    $final .= "<b>$user</b> <br>";
    foreach ($classvalue['projects'] as $project){
        $URL = "https://github.com/$user/$project";
        $page = @file_get_contents($URL);
        $find = strpos($page, "index.php");
    
        // repository is not present on github
        if (!empty($page)) {
        $final .= '<div class="completed">'.$project.' </div>';
        } else {
        $final .= '<div class="incompleted">'.$project.' </div>';
        }   

        // index file is present in repository?
        if ($find === false) {
        $final .= '<div class="incompleted">Index.php <br> </div>';
        }else{
            //index filewas found on webpage
        $final .= '<div class="completed">Index.php <br></div>';
        $userCompleted++; // $usercompleted = $usercompleted + 1
        
        }
    }
    $count = count($classvalue['projects']);
    $final .= 'Have '.$userCompleted.' / '.$count;


    $totalprojectswidth = 10 * $count; // 7*10 = 70px
    $userCompletedWidth = 10 * $userCompleted;  // 10 * 5 = 50px

    $final .= '<div style="background-color: red; height: 20px;  width:' . $totalprojectswidth .'px;display: block; ">
    <span style="background-color: green; height: 20px; width:' . $userCompletedWidth . 'px;display: block; ">
    </div>
    </span>
    
    ';
    $userCompleted = 0;

    }
}
  //echo $wp2; 



?>

<?php
echo $final;
?>

</body>
</html>