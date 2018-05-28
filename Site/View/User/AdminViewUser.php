<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel.JANSSENS
 * Date: 28.05.2018
 * Time: 12:05
 */

ob_start();

if(isset($_GET['action']))
    $action = $_GET['action'];
if(isset($_GET['userID']))
    $userID = $_GET['userID'];
?>


<table>
    <?php
    foreach($users as $row)
    {


        echo '<tr>';
        if($action=="admin_start_user_update" && $userID == $row->pkUser)
        {
            echo '<form action="index.php?action=admin_user_update" method="post" id="userForm">';
            echo '<input type="hidden" name="userID" value='.$row->pkUser.'>';
            echo'<td><input type="text" name="username" value='.$row->userName.'></td> 
                <td><input type="text" name="name" value='.$row->name.'></td> 
                <td><input type="text" name="lastName" value='.$row->lastName.'></td> 
                <td><input type="text" name="email" value='.$row->email.'></td>  
                <td><input type="text" name="password" value='.$row->password.'></td>  
                <td>
                    <select name="userType" form="userForm">';
                        foreach($types as $type)
                        {
                            if($type->pkType == "$row->fkType")
                                echo '<option selected="selected">'.$type->type.'</option>';
                            else
                                echo '<option>'.$type->type.'</option>';
                        }
                echo '
                    </select>
                </td>
                <td><input type="submit" value = "save"></td>';

            echo '</form>';

            echo '

            ';

        }
        else
        {
            echo '

                <td><a href="index.php?action=view_user_profile&userID='.$row->pkUser.'&username='.$row->userName.'">'.$row->userName.'</a></td>
                <td>'.$row->name.'</td> 
                <td>'.$row->lastName.'</td> 
                <td>'.$row->email.'</td>  
                <td>'.$row->password.'</td>  
            <td>'.$GLOBALS['userController']->GetUserType($row->userName).'</td>
                <td><a href="index.php?action=admin_start_user_update&userID='.$row->pkUser.'">update</a></td>
                <td><a href="index.php?action=admin_delete_user&userName='.$row->userName.'">delete</a></td>';
        }
        

        echo '</tr>';
    }
    ?>
</table>
<?php
    $content = ob_get_clean();

    require_once "View/Template.php";
?>
