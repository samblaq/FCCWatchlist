<?php 
    if (isset($error)) {
        echo "<div style='background-color:red' id=\"note\">
                $error
            </div>"; 
    }elseif (isset($welcome)){
        echo "<div style='background-color:green' id=\"note\">
                $welcome
            </div>";
    }elseif (isset($EmptyField)){
        echo "<div style='background-color:red' id=\"note\">
                $EmptyField
            </div>";
    }elseif (isset($notNumeric)){
            echo "<div style='background-color:red' id=\"note\">
            $notNumeric
         </div>";
    }elseif (isset($FileTypeError)){
            echo "<div style='background-color:red' id=\"note\">
            $FileTypeError
         </div>";
    }elseif (isset($uploadSuccess)){
        echo "<div style='background-color:green' id=\"note\">
                $uploadSuccess
            </div>";
    }elseif (isset($UserSuccess)){
        echo "<div style='background-color:green' id=\"note\">
                $UserSuccess
            </div>";
    }elseif (isset($pwidLength)){
        echo "<div style='background-color:red' id=\"note\">
        $pwidLength
     </div>";
    }elseif (isset($passwordLength)){
        echo "<div style='background-color:red' id=\"note\">
        $passwordLength
     </div>";
    }
?>