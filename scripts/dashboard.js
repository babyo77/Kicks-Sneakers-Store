const logout = document.querySelector("#logout");
const cancel = document.querySelector("#Cancel");
const alerts = document.querySelector(".alert");
const Account = document.querySelector("#Account");
const menu = document.querySelector("#user-menu");
const main = document.querySelector(".main");
const log_out = document.querySelector(".log-out");
const body = document.querySelector("#body");
const close_profile_details = document.querySelector("#close-profile-details");
const edit_profile_details = document.querySelector(".edit-profile-details");
const edit_profile = document.querySelector(".edit-profile");
const close_address_details = document.querySelector("#close-address-details");
const edit_address_details = document.querySelector(".edit-address-details");
const address = document.querySelector(".address");
const close_bag_details = document.querySelector("#close-bag-details");
const bag_items_details = document.querySelector(".bag-items-details");
const bag = document.querySelector(".bag");
const cart = document.querySelectorAll(".cart-item");
const badge = document.querySelector(".badge");
let i= 0

bag.onclick = () => {
  event.preventDefault();
  bag_items_details.classList.remove("slideout-items");
  bag_items_details.classList.add("slidein-items");

  document.addEventListener("mouseover", () => {
    if (!bag_items_details.contains(event.target)) {
      bag_items_details.classList.remove("slidein-items");
      bag_items_details.classList.add("slideout-items");
    }
  });
};

close_bag_details.onclick = () => {
  bag_items_details.classList.remove("slidein-items");
  bag_items_details.classList.add("slideout-items");
};

edit_profile.onclick = () => {
  event.preventDefault();
  edit_profile_details.classList.remove("slideout");
  edit_profile_details.classList.add("slidein");
};

close_profile_details.onclick = () => {
  edit_profile_details.classList.remove("slidein");
  edit_profile_details.classList.add("slideout");
};

address.onclick = () => {
  event.preventDefault();
  edit_address_details.classList.remove("slideout");
  edit_address_details.classList.add("slidein");
};

close_address_details.onclick = () => {
  edit_address_details.classList.remove("slidein");
  edit_address_details.classList.add("slideout");
};

cancel.onclick = () => {
  alerts.style.display = "none";
};

logout.onclick = () => logoutPage();

log_out.onclick = () => {
  event.preventDefault();
  logoutPage();
};
function logoutPage() {
  fetch("../api/logout.php")
    .then((response) => {
      if (response.status === 200) {
        alerts.style.display = "none";
        location.reload();
      } else {
        alert("Logout failed");
      }
    })
    .catch((error) => {
      console.error("Error during logout:", error);
    });
}

if (Account) {
  Account.onclick = () => {
    alerts.style.display = "flex";
    menu.checked = false;
  };
}

alerts.onclick = () => {
  alerts.style.display = "none";
};

document.addEventListener("click", () => {
  if (!menu.contains(event.target)) {
    menu.checked = false;
  }
});

cart.forEach(item=>{
  console.log(item);
  i++
  badge.textContent = i

})