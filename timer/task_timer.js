let timers = {};

function startTimer(taskId) {
    if (!timers[taskId]) {
        const startTime = new Date().toISOString();
        timers[taskId] = { time: 0, interval: null, startTime: startTime };

        timers[taskId].interval = setInterval(() => {
            timers[taskId].time++;
            document.getElementById(`timer-${taskId}`).innerText = timers[taskId].time + " seconds	";
        }, 1000);
    }
}

function stopTimer(taskId) {
    if (timers[taskId]) {
        clearInterval(timers[taskId].interval);
        const totalTime = timers[taskId].time;
        const endTime = new Date().toISOString();

        window.location.href = `../timer/record_task_time.php?action=record&id=${taskId}&start_time=${timers[taskId].startTime}&end_time=${endTime}&total_time=${totalTime}`;
        
        delete timers[taskId];
    }
}