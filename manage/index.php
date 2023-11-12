<?php
require "manage_header.php";
?>

<!-- title -->
<section class="container form-title">
    <div class="container wd-color3">
        <div class="d-flex flex-nowrap mt-5 ms-4">
            <i class="fa-solid fa-house fa-2x pe-3"></i>
            <h4 class="pt-1"><b>粼粼．後臺管理系統首頁</b></h4><br />
        </div>
        <div class="row mt-4 ms-4">
            <div class="col-12 col-md-6">
                <h6>《 歡迎光臨_粼粼後臺管理系統 》</h6>
            </div>
            <div class="col-12 col-md-6">
                <h6><?= $_SESSION['sname'] ?>您好！<br>登入時間：<time><?= $_SESSION['sLogintime'] . date(" A") ?></time></h6>
            </div>
        </div>
    </div>
</section>

<!-- main -->
<section class="container">
    <div class="row mt-5">
        <div class="col-12">
            <h5 class="text-center wd-color"><b>Calendar</b></h5>
            <div class="container calendarDiv">
                <div class="row">
                    <div class="col-12 monthChangBtn">
                        <div class="prevBtn" id="prevBtn">
                            <i class="fa-solid fa-circle-chevron-left fa-1x"></i>
                        </div>
                        <div class="currentInfo" id="currentInfo"></div>
                        <div class="nextBtn" id="nextBtn">
                            <i class="fa-solid fa-circle-chevron-right fa-1x"></i>
                        </div>
                    </div>
                    <div class="col-12 calendar" id="calendar">
                        <table>
                            <tr>
                                <td>日</td>
                                <td>一</td>
                                <td>二</td>
                                <td>三</td>
                                <td>四</td>
                                <td>五</td>
                                <td>六</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    const calendarTable = document.querySelector('.calendar table');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const currentInfo = document.getElementById('currentInfo');

    let currentDate = new Date();
    let currentYear = currentDate.getFullYear();
    let currentMonth = currentDate.getMonth();
    let selectedDates = new Set();

    function updateCalendar() {
        const weekdayNames = ['日', '一', '二', '三', '四', '五', '六'];
        calendarTable.innerHTML = ''; // Clear previous calendar

        // Display the current month and year
        currentInfo.textContent = `${currentYear}年${currentMonth + 1}月`;

        // Create the header row with weekday names
        const headerRow = calendarTable.insertRow();
        for (const weekday of weekdayNames) {
            const headerCell = headerRow.insertCell();
            headerCell.textContent = weekday;
        }

        // Get the first day and last day of the current month
        const firstDay = new Date(currentYear, currentMonth, 1).getDay();
        const lastDay = new Date(currentYear, currentMonth + 1, 0).getDate();

        // Create the calendar grid
        let date = 1;
        for (let row = 0; row < 6; row++) {
            const newRow = calendarTable.insertRow();

            for (let col = 0; col < 7; col++) {
                const newCell = newRow.insertCell();

                if (row === 0 && col < firstDay) {
                    // Empty cells before the first day of the month
                } else if (date > lastDay) {
                    // Stop after the last day of the month
                } else {
                    newCell.textContent = date;
                    newCell.addEventListener('click', () => toggleDate(date, newCell));
                    if (selectedDates.has(date)) {
                        newCell.classList.add('selected');
                    }
                    date++;
                }
            }
        }
    }

    function toggleDate(date, cell) {
        if (selectedDates.has(date)) {
            selectedDates.delete(date);
            cell.classList.remove('selected');
        } else {
            selectedDates.add(date);
            cell.classList.add('selected');
        }
    }

    prevBtn.addEventListener('click', () => {
        if (currentMonth === 0) {
            currentYear--;
            currentMonth = 11;
        } else {
            currentMonth--;
        }
        updateCalendar();
    });

    nextBtn.addEventListener('click', () => {
        if (currentMonth === 11) {
            currentYear++;
            currentMonth = 0;
        } else {
            currentMonth++;
        }
        updateCalendar();
    });

    updateCalendar();
</script>

<?php
require "manage_footer.php";
?>