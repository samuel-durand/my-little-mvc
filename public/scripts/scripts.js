const productList = document.querySelector("#productList");
const messageNotif = document.querySelector("#messageNotif");
const containerFormEdit = document.querySelector("#containerFormEdit");

const erraseMessage = () => {
  setTimeout(() => {
    messageNotif.innerHTML = "";
  }, 3000);
};
const getProduct = async () => {
  const response = await fetch("/my-little-mvc/admin/products");
  const data = await response.json();
  return data;
};

const getUsers = async () => {
  const response = await fetch("/my-little-mvc/admin/users");
  const data = await response.json();
  return data;
};

const deleteUser = async (userId) => {
  console.log(userId);
  const response = await fetch(`/my-little-mvc/admin/users/delete/${userId}`,{method:'POST'});
    const data = await response.json();
    /*if(data === "success"){*/
    DisplayUsers();
    /*}*/
}
deleteUser();



const DisplayUsers = async () => {
  const users = await getUsers();
  let usersHTML = "<table><tr><th>id</th><th>Name</th><th>Email</th><th>Actions</th></tr>";

  users.forEach(user => {
    usersHTML += `<tr>
                    <td><input id="fullname-${user.id}"  value="${user.id}"></td>
                    <td><input id="fullname-${user.id}" name="fullname" value="${user.fullname}"></td>
                    <td><input id="email-${user.id}" name="email" value="${user.email}"></td>
                    <td>
                      <button onclick="edituser('${user.id}', '${user.fullname}', '${user.email}')">Edit</button>
                      <button onclick="deleteUser('${user.id}')">Delete</button>
                    </td>
                  </tr>`;
  });

  usersHTML += "</table>";
  document.getElementById("test").innerHTML = usersHTML;
}


const editUser = async (userId) => {
  console.log(userId);
  const response = await fetch(`/my-little-mvc/admin/users/edit/${userId}`,{method:'POST'});
  const data = await response.json();
  /*if(data === "success"){*/
  DisplayUsers();

}

edituser =  (id, fullname, email) => {

  console.log(fullname, email, id);

  containerFormEdit.innerHTML = "";
    containerFormEdit.innerHTML =


        `
        <form method="POST" id="formEditUser" action="/my-little-mvc/admin/users/edit/${id}" class="bg-[#F2F2F3] p-2 rounded-lg">
        <div class="flex flex-wrap justify-between">
         
            <div class="flex flex-col gap-1">
                <label for="fullname">Fullname</label>
                <input  type="text" name="fullname" value="${fullname}" class="p-1 rounded-lg bg-[#F2F2F3] border border-black">
            </div>
            
            <div class="flex flex-col gap-1">
                <label for="email">Email</label>
                <input type="text" name="email" value="${email}" class="p-1 rounded-lg bg-[#F2F2F3] border border-black">
            </div>
        </div>
        <div class="h-16">
            <p id="messageNotifEdit" class="text-red-500"></p>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-green-400 p-2 rounded-lg">Editer</button>
            <button type="button" class="bg-grey-400 p-2 rounded-lg" onclick="containerFormEdit.innerHTML = ''">Annuler</button>
        </div>
         </form>

       `;
    const formEditUser = document.querySelector("#formEditUser");
    const messageNotifEdit = document.querySelector("#messageNotifEdit");
    formEditUser.addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(formEditUser);
        const res = await fetch(`/my-little-mvc/admin/users/edit/${id}`, {
            method: "POST",
            body: formData,
        });
        console.log(res);
        const data = await res.json();
        messageNotifEdit.innerHTML = "";
        if (data.error) {
            messageNotifEdit.innerHTML = data.error;
            erraseMessage();
        }
        if (data.success) {
            messageNotifEdit.innerHTML = data.success;
            erraseMessage();
            DisplayUsers();
            containerFormEdit.innerHTML = "";
        }
    });
}




DisplayUsers();

getUsers().then((data) => {
  console.log(data);
});

deleteProduct = async (id) => {
  const response = await fetch(`/my-little-mvc/admin/products/delete/${id}`, {
    method: "POST",
  });
  const data = await response.json();
  messageNotif.innerHTML = "";
  if (data.error) {
    messageNotif.innerHTML = data.error;
    erraseMessage();
  }
  if (data.success) {
    messageNotif.innerHTML = data.success;
    erraseMessage();
    displayProducts();
  }
};

editProduct = (id, name, price, quantity, description) => {
  containerFormEdit.innerHTML = "";
  containerFormEdit.innerHTML = `
  <div id="dialog" class="fixed left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10">
    <form method="POST" id="formEditProduct" action="/my-little-mvc/admin/products/edit/${id}" class="bg-[#F2F2F3] p-2 rounded-lg">
    <div class="flex flex-wrap justify-between">
      <div class="flex flex-col gap-1">
          <label for="name">Name</label>
          <input type="text" name="name" value="${name}" class="p-1 rounded-lg bg-[#F2F2F3] border border-black">
      </div>
      <div class="flex flex-col gap-1">
        <label for="price">Price</label>
        <input type="text" name="price" value="${price}" class="p-1 rounded-lg bg-[#F2F2F3] border border-black">
      </div>
      <div class="flex flex-col gap-1">
        <label for="quantity">Quantity</label>
        <input type="text" name="quantity" value="${quantity}" class="p-1 rounded-lg bg-[#F2F2F3] border border-black">
      </div>
    </div>
    <div class="flex flex-col gap-1">
      <label for="description">Description</label>
      <input type="text" name="description" value="${description}" class="p-1 rounded-lg bg-[#F2F2F3] border border-black h-16">
    </div>
    <div class="h-16">
      <p id="messageNotifEdit" class="text-red-500"></p>
    </div>
    <div class="flex gap-2">
      <button type="submit" class="bg-green-400 p-2 rounded-lg">Editer</button>
      <button type="button" class="bg-grey-400 p-2 rounded-lg" onclick="containerFormEdit.innerHTML = ''">Annuler</button>
    </div>
    </form>
  </div>`;

  const formEditProduct = document.querySelector("#formEditProduct");
  const messageNotifEdit = document.querySelector("#messageNotifEdit");

  formEditProduct.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(formEditProduct);
    const res = await fetch(`/my-little-mvc/admin/product/edit/${id}`, {
      method: "POST",
      body: formData,
    });
    console.log(res);
    const data = await res.json();
    messageNotifEdit.innerHTML = "";
    if (data.error) {
      messageNotifEdit.innerHTML = data.error;
      erraseMessage();
    }
    if (data.success) {
      messageNotifEdit.innerHTML = data.success;
      erraseMessage();
      displayProducts();
      containerFormEdit.innerHTML = "";
    }
  });
};

displayProducts = () => {
  getProduct().then((data) => {
    productList.innerHTML = "";
    productList.innerHTML = `<table class="border-collapse w-min-400px w-full mx-6 text-sm shadow-md rounded-t-lg">
            <thead class="bg-gradient-to-r from-fuchsia-500 to-violet-500">
              <tr class="text-white">
                <th class="text-center px-3 py-4">Product Name</th>
                <th class="text-center px-3 py-4">Price</th>
                <th class="text-center px-3 py-4">Quantity</th>
                <th class="text-center px-3 py-4 w-1/2">Description</th>
                <th class="text-center px-3 py-4">Actions</th>
              </tr>
            </thead>
            <tbody id="bodyProductsList"></tbody>
        </table>`;

    const bodyProductsList = document.querySelector("#bodyProductsList");
    for (let i = 0; i < data.length; i++) {
      bodyProductsList.innerHTML += `
      <tr class="${
        i % 2 === 0 ? "bg-gray-200" : ""
      } border-b border-gray-200 last:border-b-2 last:border-violet-500">
          <td class="p-1">${data[i].name}</td>
          <td class="p-1">${data[i].price} €</td>
          <td class="p-1">${data[i].quantity}</td>
          <td class="p-1">${data[i].description}</td>
          <td class="p-1">
          <button class="bg-green-200 rounded px-1" onclick="editProduct(${
            data[i].id
          }, '${data[i].name}', '${data[i].price}', ${data[i].quantity}, '${
        data[i].description
      }')">Editer</button>
          <button class="bg-red-200 rounded px-1" onclick="deleteProduct(${
            data[i].id
          })">Supprimer</button>
          </td>
      </tr>`;
    }
  });
};

/*displayProducts();*/
