

let avatar = document.getElementById('avatar')
let avatarPreview = document.getElementById('avatar-preview')
avatar.onchange = (e) => {
    const file = avatar.files[0]
    if (file) {
        avatarPreview.src = URL.createObjectURL(file)
    }
}