<?php
// Get the current or past month and year as parameters.
$month = isset($_GET['month']) ? $_GET['month'] : date('m');
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');

// Calculate the first day of the month and the total number of days.
$firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
$daysInMonth = date('t', $firstDayOfMonth);
$dayOfWeek = date('w', $firstDayOfMonth);

// Name of the month in English
$monthName = (new DateTime("{$year}-{$month}-01"))->format('F');

// Define the days of the week.
$daysOfWeek = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

echo "<div class='calendar-container'>";

// Display the month and year at the top
echo "<div class='calendar-header'>";
echo "<h2>$monthName $year</h2>";
echo "</div>";

// Generate the calendar table
echo "<table class='calendar'>";
echo "<tr>";
foreach ($daysOfWeek as $day) {
    echo "<th>$day</th>";
}
echo "</tr><tr>";

// Align the first day of the month with the correct day of the week.
if ($dayOfWeek > 0) {
    echo str_repeat("<td></td>", $dayOfWeek);
}

// Fill the calendar with the days of the month.
for ($day = 1; $day <= $daysInMonth; $day++) {
    $dateValue = "$year-$month-" . str_pad($day, 2, '0', STR_PAD_LEFT); // Format date as YYYY-MM-DD
    
    // Check if the current day matches
    $class = ($day == date('d') && $month == date('m') && $year == date('Y')) ? 'today' : '';
    
    echo "<td class='$class'>";
    echo "<div class='day-cell'>";
    
    // Day number in the top-left corner
    echo "<div class='day-number'>$day</div>";
    
    //     echo "<button class='day-button' onclick=\"document.getElementById('addNoteForm-$day')->style.display='block'\">+</button>";
    
    //     // Formulario de añadir nota (oculto inicialmente)
    //     echo "<div id='addNoteForm-$day' style='display:none;'>";
    //     echo "<form action='' method='POST'>";
    //     echo "<input type='hidden' name='note_date' value='$dateValue'>";
    //     echo "<input type='text' name='note_text' placeholder='Ingrese su nota' required>";
    //     echo "<button type='submit' name='action' value='add' class='submit-button'>Añadir Nota</button>";
    //     echo "</form>";
    //     echo "</div>"; // Cierra el div del formulario
    
    //     echo "</div>"; // Cierra day-cell
    //     echo "</td>";
    
    // Button "+" in the top-right corner
    echo "<form action='' method='POST' class='day-form'>";
    echo "<input type='hidden' name='selected_date' value='$dateValue'>";
    //     echo "<input type='text' name='note_text' placeholder='Enter your note' required>"; // This was the 1st try
    
    echo "<button type='button' class='day-button' onclick=\"openModal('$dateValue')\">+</button>";
    
    include 'pop_up.php';
    
    //echo "<button class='day-button' onclick=\"openModal('$dateValue')\">+</button>"; // New
    
    //     echo "<button type='submit' name='action' value='add' class='day-button'>+</button>";
    echo "</form>";
    
    echo "</div>"; // Close day-cell
    echo "</td>";
    
    // Move to the next row after Saturday.
    if (($day + $dayOfWeek) % 7 == 0) {
        echo "</tr><tr>";
    }
}


// Fill the end of the week if the month ends before Saturday.
if (($dayOfWeek + $daysInMonth) % 7 != 0) {
    echo str_repeat("<td></td>", 7 - (($dayOfWeek + $daysInMonth) % 7));
}

echo "</tr></table>";
echo "</div>"; // Closes the calendar container


// Variables for the next and previous month.
$prevMonth = $month - 1;
$nextMonth = $month + 1;
$prevYear = $nextMonth == 1 ? $year - 1 : $year;
$nextYear = $nextMonth == 13 ? $year + 1 : $year;

echo "<br/>";
echo "<div class='calendar-nav'>";
echo "<a href='?month=$prevMonth&year=$prevYear'>Previous Month</a> | ";
echo "<a href='?month=$nextMonth&year=$nextYear'>Next Month</a>";
echo "</div>";

?>