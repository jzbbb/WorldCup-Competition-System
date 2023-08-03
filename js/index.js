const loginBtn = document.querySelector('#login-btn')
const form = document.querySelector('.sign-in-form')

loginBtn.addEventListener('click', function (e) {
  e.preventDefault()
  const account = document.querySelector('[name="account"]').value
  const pass = document.querySelector('[name="pass"]').value
  if (pass.length == 0 || account.length == 0) {
    myAlert(false, '请输入账号或密码')
  }
  else {
    axios.post(
      "../login_check.php",
      {
        account,
        pass
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
