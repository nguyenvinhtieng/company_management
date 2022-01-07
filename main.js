
if (document.getElementById('avatar-preview')) {
    let avatar = document.getElementById('avatar')
    let avatarPreview = document.getElementById('avatar-preview')
    avatar.onchange = (e) => {
        const file = avatar.files[0]
        if (file) {
            avatarPreview.src = URL.createObjectURL(file)
        }
    }
}
if (document.querySelectorAll('.btn-see-employee')) {
    let btnSees = document.querySelectorAll('.btn-see-employee')
    let UserName = document.getElementById('username')
    let Name = document.getElementById('name')
    let DepartmentId = document.getElementById('department-id')
    let DepartmentName = document.getElementById('department-name')
    let Position = document.getElementById('position')
    let Avatar = document.getElementById('avatar')
    btnSees.forEach(btn => {
        btn.onclick = () => {
            let username = btn.getAttribute("data-username");
            let name = btn.getAttribute("data-name");
            let department_id = btn.getAttribute("data-department-id");
            let department_name = btn.getAttribute("data-department-name");
            let position = btn.getAttribute("data-position");
            let avatar = btn.getAttribute("data-avatar");
            UserName.value = username
            Name.value = name
            DepartmentId.value = department_id
            DepartmentName.value = department_name
            Position.value = position
            Avatar.src = `../images/${avatar}`
        }
    })
}
if (document.querySelectorAll('.btn-reset')) {
    let btnResets = document.querySelectorAll('.btn-reset')
    let usernameUser = document.getElementById('username_user')
    btnResets.forEach(btn => {
        btn.onclick = () => {
            let username = btn.getAttribute("data-username");
            usernameUser.value = username
        }
    })
}
if (document.querySelectorAll('.cancel')) {
    let cancels = document.querySelectorAll('.cancel');
    let taskIdCanceled = document.getElementById('task_id_canceled')
    cancels.forEach(btn => {
        btn.onclick = () => {
            let id_task = btn.getAttribute("data-id");
            taskIdCanceled.value = id_task;
        }
    })
}

if (document.querySelectorAll('.refu')) {
    let refuses = document.querySelectorAll('.refu');
    let idApplicationRefused = document.getElementById('id_application_refused')
    refuses.forEach(btn => {
        btn.onclick = () => {
            let id_application = btn.getAttribute('data-id');
            idApplicationRefused.value = id_application;
        }
    })
}
if (document.querySelectorAll('.appr')) {
    let approves = document.querySelectorAll('.appr');
    let idApplicationApproved = document.getElementById('id_application_approved')
    approves.forEach(btn => {
        btn.onclick = () => {
            let id_application = btn.getAttribute('data-id');
            idApplicationApproved.value = id_application;
        }
    })
}