const footer = document.querySelector('.layui-footer')
const date = new Date()
footer.innerHTML = '<i class="layui-icon layui-icon-time" ></i >  ' + date.toLocaleString()

setInterval(function () {
  const date = new Date()
  footer.innerHTML = '<i class="layui-icon layui-icon-time" ></i >  ' + date.toLocaleString()
}, 1000)

