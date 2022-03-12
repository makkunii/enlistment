<?php
session_start();

include_once "config.php";
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$connection)
{
    echo mysqli_error($connection);
    throw new Exception("Database cannot Connect");
}
$action = $_REQUEST['action']??'';

if ('login' == $action)
{
    $Username = $_REQUEST['Username']??'';
    $password = $_REQUEST['password']??'';
    $role = $_REQUEST['role']??'';

    if ($role == 'employee')
    {
        if ($Username && $password && $role)
        {
            $query = "SELECT * FROM employee WHERE Username='{$Username}'";
            $result = mysqli_query($connection, $query);

            if ($data = mysqli_fetch_assoc($result))
            {
                $_passsword = $data['password']??'';
                $_Uusername = $data['Username']??'';
                $_Department = $data['Department']??'';
                $_id = $data['employeeID']??'';
                $_role = $data['role']??'';

                if (password_verify($password, $_passsword))
                {
                    $_SESSION['role'] = $_role;
                    $_SESSION['employeeID'] = $_id;
                    $_SESSION['Department'] = $_Department;

                    header("location:employee.php");
                    die();
                }
				else
            {
                header("location:login.php?error");
            }
				
            }
            else
            {
                header("location:login.php?error");
            }

        }
    }
    else if ($role == 'admin')
    {
        if ($Username && $password && $role)
        {
            $query = "SELECT * FROM admin WHERE Username='{$Username}'";
            $result = mysqli_query($connection, $query);

            if ($data = mysqli_fetch_assoc($result))
            {
                $_passsword = $data['password']??'';
                $_Uusername = $data['Username']??'';
                $_id = $data['id']??'';
                $_role = $data['role']??'';

                if (password_verify($password, $_passsword))
                {
                    $_SESSION['role'] = $_role;
                    $_SESSION['id'] = $_id;
                    header("location:index.php");
                    die();
                }
				else
            {
                header("location:login.php?error");
            }
            }
            else
            {
                header("location:login.php?error");
            }

        }
    }

}

