const logout = document.querySelector("#logout");
const cancel = document.querySelector("#Cancel");
const alerts = document.querySelector(".alert");
const Account = document.querySelector("#Account");
const menu = document.querySelector("#user-menu");

cancel.onclick=()=>{
    alerts.style.display="none"
}

logout.onclick=()=>{
        fetch('api/logout.php')
          .then(response => {
            if (response.status === 200) {
              alerts.style.display = 'none';
              location.reload()
            } else {
              alert('Logout failed');
            }
          })
          .catch(error => {
            console.error('Error during logout:', error);
          });
      }

Account.onclick=()=>{
alerts.style.display='flex'
menu.checked=false
}

alerts.onclick=()=>{
  alerts.style.display="none"
}