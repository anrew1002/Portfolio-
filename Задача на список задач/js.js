
(function () {
    let list_tasks = document.querySelector(".todo-list__list");
    let form = document.querySelector(".card");
    let save_btn = form.querySelector(".card__button-save");
    // save_btn.preventDefault
    list_tasks.addEventListener('click', function (e) {
        let target = e.target;
        let task = e.target.closest(".task");
        let important = task.querySelector(".task__important");
        let discription = task.querySelector(".task__discription");

        let saveTask = (task) => (e) => {
            e.preventDefault()
            discription.textContent = form.discription.value;
            important.textContent = form.important.checked ? "💢" : "";
            form.reset();
            form.classList.toggle("notshown");
        };

        if (target.classList.contains("task__button-edit")) {
            form.classList.toggle("notshown")
            form.discription.value = discription.textContent;
            if (important.textContent) {
                form.important.checked = true;
            } else {
                form.important.checked = false;
            };
            form.onsubmit = saveTask(task);
        };
        if (target.classList.contains("task__button-del")) {
            task.remove()
        };

    });
    let add_btn = document.querySelector(".todo-list__button");
    add_btn.addEventListener('click', event => {
        form.classList.toggle("notshown")
        let addTask = (e) => {
            e.preventDefault()
            let newtask = document.querySelector('.zero-task').cloneNode(true);
            newtask.querySelector(".task__important").textContent = form.important.checked ? "💢" : "";
            newtask.querySelector(".task__discription").textContent = form.discription.value;
            list_tasks.append(newtask)
            form.reset()
            form.classList.toggle("notshown")
        }
        form.onsubmit = addTask;
    });
})();