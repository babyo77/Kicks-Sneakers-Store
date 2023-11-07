const logout = document.querySelector("#logout");
const cancel = document.querySelector("#Cancel");
const alert = document.querySelector(".alert");
const Account = document.querySelector("#Account");

cancel.onclick=()=>{
    alert.style.display="none"
}

logout.onclick=()=>{
        fetch('api/logout.php')
          .then(response => {
            if (response.status === 200) {
              alert.style.display = 'none';
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
alert.style.display='flex'
}