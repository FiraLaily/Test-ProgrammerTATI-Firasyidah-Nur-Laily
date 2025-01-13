<?php
function helloworld($n) {
    for ($i = 1; $i <= $n; $i++) {
        $output = "";  // Initialize output for each iteration

        // Loop through and append values with conditions
        for ($a = 1; $a <= $i; $a++) {
            if ($a % 4 == 0 && $a % 5 == 0) {
                $output .= "helloworld "; // Append "helloworld" when divisible by both 4 and 5
            } elseif ($a % 4 == 0) {
                $output .= "hello "; // Append "hello" when divisible by 4
            } elseif ($a % 5 == 0) {
                $output .= "world "; // Append "world" when divisible by 5
            } else {
                $output .= $a . " "; // Append the number itself otherwise
            }
        }
        
        // Print the result for the current value of $i with <br> as line break
        echo "helloworld($i) => " . trim($output) . "<br>"; // Use <br> for line break in browser
    }
}

helloworld(6);  // Call the function with the sample input
?>
