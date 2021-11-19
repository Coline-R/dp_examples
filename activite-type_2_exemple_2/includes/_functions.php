<?php

    // CHECK USER ADMIN CONNECTE
    function isUserAdmin(){
        if(!isset($_SESSION['user']) && $_SESSION['user']['role'] != 'admin')
        {
            header("location:index.php");
        } 
    }

    // RENVOI MSG EN FONCTION DU FEEDBACK SUR LES ACTIONS BDD

    function bddFeedback(){
        if (isset($_GET['feedback']))
        {
            switch($_GET['feedback'])
            {
                case 'deleted':
                    echo '
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            La supression a bien été effectuée.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    break;
                case 'modified':
                    echo '
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            La modification a bien été effectuée.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    break;
                case 'added':
                    echo '
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            L\'ajout a bien été effectuée.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    break;
                default:
                    echo '
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            L\'action a bien été effectuée.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    break;
            }
        }
    }