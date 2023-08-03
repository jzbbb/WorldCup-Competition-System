const loginBtn = document.querySelector('[lay-submit]')
const form = document.querySelector('.layui-form')

loginBtn.addEventListener('click', function (e) {
  e.preventDefault()
  const username = document.querySelector('[name="username"]').value
  const password = document.querySelector('[name="password"]').value
  if (password.length == 0 || username.length == 0) {
    myAlert(false, '请输入账号或密码')
  }
  else {
    axios.post(
      "../login_check.php",
      {
        username,
        password
      },
      {
        headers: {
          'Content-Type': 'application/json;charset=UTF-8'
        }
      }
    ).then(result => {
      if (result.data.status) {
        myAlert(true, result.data.message)
        form.reset()
        setTimeout(function () {
          location.href = '../admin/admin_index.php'
        }, 1500)
      }
      else {
        myAlert(false, result.data.message)
        document.querySelector('[name="pass"]').value = ''
      }
    })
  }
})
