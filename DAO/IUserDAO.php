<?php
    namespace DAO;
    use Models\User as User;
    interface IUserDAO
    {
        function Add(User $user);
        function AddFacebook($email,$first_name,$last_name);
        function GetAll();
        function GetIdRole($role);
        function GetRoleById($idRole);
        function emailVerification($email);
        function setNewPassword($password,$user);
        function setUserNewProfile($userProfile,$user);
    }
?>