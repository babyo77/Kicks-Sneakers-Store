'use strict'
const logout = document.querySelector("#logout");
const cancel = document.querySelector("#Cancel");
const alerts = document.querySelector(".alert");
const Account = document.querySelector("#Account");
const menu = document.querySelector("#user-menu");
const close_bag_details = document.querySelector("#close-bag-details");
const bag_items_details = document.querySelector(".bag-items-details");
const bag = document.querySelector(".bag");
const popup = document.querySelector(".popup");
const cart = document.querySelectorAll(".cart-item");
const badge = document.querySelector(".badge");
const item = document.querySelector(".items");
const total = document.querySelector(".checkout button h1");
total.remove();
const checkout = document.querySelector(".checkout");
let i = 0;

bag.onclick = (e) => {
  e.preventDefault();
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

cancel.onclick = () => {
  alerts.style.display = "none";
};

logout.onclick = () => {
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
};

if (Account) {
  Account.onclick = () => {
    alerts.style.display = "flex";
    menu.checked = false;
  };
}
alerts.onclick = () => {
  alerts.style.display = "none";
};

document.addEventListener("click", (e) => {
  if (!menu.contains(e.target)) {
    menu.checked = false;
  }
});

/* add to cart */

let PreviousTotal = 0;

if (document.querySelector(".checkout button h1")) {
  PreviousTotal = parseFloat(
    document
      .querySelector(".checkout button h1")
      .textContent.replace(/[^\d.]/g, "")
  );
}

var addToCartButtons = document.querySelectorAll(".add-to-cart-btn");

addToCartButtons.forEach((button) => {
  button.addEventListener("click", function () {
    popup.style.display = "none";
    popup.classList.remove("in");

    var productId =
      this.closest(".shoe-details").getAttribute("data-product-id");

    var productAmount = this.closest(".shoe-details .shoe-price");

    var amountToAdd = parseFloat(
      productAmount.querySelector("h1").textContent.replace(/[^\d.]/g, "")
    );

    PreviousTotal += amountToAdd;

    fetch("../api/add_to_cart.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "product_id=" + encodeURIComponent(productId),
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        badge.textContent = data.cart;
        if (!document.querySelector(".checkout button h1")) {
          let button = document.createElement("button");
          let h1 = document.createElement("h1");
          h1.textContent = `Checkout Total: ₹ ${Number(
            PreviousTotal
          ).toLocaleString(undefined, {
            maximumFractionDigit: 2,
            minimumFractionDigits: 2,
          })}`;
          button.append(h1);
          checkout.append(button);
        } else {
          document.querySelector(
            ".checkout button h1"
          ).textContent = `Checkout Total: ₹ ${data.total}`;
        }

        updateUI(data.id);

        popup.style.display = "flex";
        popup.classList.add("in");

        setTimeout(() => {
          popup.style.display = "none";
        }, 1000);
      })
      .catch((error) => {
        console.error("Fetch Error:", error);
      });
  });
});

function updateUI(productID) {
  let ExistingCartItem = document.querySelector(
    `.cart-item[data-cart-id='${productID}']`
  );
  if (ExistingCartItem) {
    ExistingCartItem.querySelector(".shoe-prices input#quantity").value++;
  } else {
    if (document.querySelector(".items h2")) {
      document.querySelector(".items h2").remove();
    }
    fetch(`../api/product_details.php?product_id=${productID}`)
      .then((response) => {
        if (!response.ok) {
          throw new Error("error");
        }
        return response.json();
      })
      .then((product) => {
        item.insertAdjacentHTML(
          "beforeend",
          `
    <div class='cart-item' data-cart-id='${product.product_id}'>
        <div class='shoe-image'>
            <img src='../Assets/Shoes Images/${product.path}'>
        </div>
        <div class='cart-item-details'>
            <div class='shoe-name'>
                <h3>${product.product_name}</h3>
            </div>
            <div class='shoe-desc'>
                <p>${product.product_desc}</p>
            </div>
            <div class='shoe-prices'>
            <h1>₹ ${Number(product.product_price).toLocaleString(undefined, {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2,
            })}</h1>
            <input type='number' id='quantity' value='1' min='1'>
            <button class='remove-from-cart-btn'>Remove</button>
          </div>          
        </div>
    </div>`
        );

        var removeFromCartButtons = document.querySelectorAll(
          ".remove-from-cart-btn"
        );

        removeFromCartButtons.forEach((button) => {
          button.addEventListener("click", function () {
            var productId =
              this.closest(".cart-item").getAttribute("data-cart-id");
            fetch("../api/remove_from_cart.php", {
              method: "POST",
              headers: {
                "Content-Type": "application/x-www-form-urlencoded",
              },
              body: "product_id=" + encodeURIComponent(productId),
            })
              .then((response) => {
                if (!response.ok) {
                  throw new Error("Network response was not ok");
                }
                return response.json();
              })
              .then((data) => {
                
                
                badge.textContent = data.cart == 0 ? "" : data.cart;
                document
                  .querySelector(`.cart-item[data-cart-id="${data.id}"]`)
                  .remove();
                  if(data.cart== 0){
                    document.querySelector(".checkout button").remove()
                  }
                document.querySelector(
                  ".checkout button h1"
                ).textContent = `Checkout Total: ₹ ${data.total}`;
              })
              .catch((err) => {
                console.log(err);
              });
          });
        });
      });
  }
}

var removeFromCartButtons = document.querySelectorAll(".remove-from-cart-btn");

removeFromCartButtons.forEach((button) => {
  button.addEventListener("click", function () {
    var productId = this.closest(".cart-item").getAttribute("data-cart-id");
    fetch("../api/remove_from_cart.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "product_id=" + encodeURIComponent(productId),
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }

        return response.json();
      })
      .then((data) => {
        if(data.cart==0){
          document.querySelector(".checkout button").remove()
        }
        badge.textContent = data.cart == 0 ? "" : data.cart;
        document
          .querySelector(`.cart-item[data-cart-id="${data.id}"]`)
          .remove();
        document.querySelector(
          ".checkout button h1"
        ).textContent = `Checkout Total: ₹ ${data.total}`;
      })
      .catch((err) => {
        console.log(err);
      });
  });
});
