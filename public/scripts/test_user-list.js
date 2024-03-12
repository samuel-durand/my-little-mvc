const userList = document.querySelector("#userList");
const messageNotif = document.querySelector("#messageNotif");
const containerFormEdit = document.querySelector("#containerFormEdit");
const btnUser = document.querySelector("#btnUser");
const btnProduct = document.querySelector("#btnProduct");

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


const DisplayUsers = async () => {
    const users = await getUsers();
    let usersHTML = `<table class="border-collapse w-min-400px w-full mx-6 text-sm shadow-md rounded-t-lg">
    <thead class="bg-gradient-to-r from-fuchsia-500 to-violet-500">
    <tr class="text-white">
    <th class="text-center px-3 py-4">id</th>
    <th class="text-center px-3 py-4">Name</th>
    <th class="text-center px-3 py-4">Email</th>
    <th class="text-center px-3 py-4">Actions</th>
    </tr>
    </thead>
    `;

    users.forEach((user) => {
        usersHTML += `<tr>
                    <td class="text-center p-1">${user.id}</td>
                    <td class="text-center p-1">${user.fullname}</td>
                    <td class="text-center p-1">${user.email}</td>
                    <td class="text-center p-1">
                      <button class="bg-green-200 rounded px-1" onclick="edituser('${user.id}', '${user.fullname}', '${user.email}')">Edit</button>
                      <button class="bg-red-200 rounded px-1" onclick="deleteUser('${user.id}')">Delete</button>
                    </td>
                  </tr>`;
    });

    usersHTML += "</table>";
    userList.innerHTML = usersHTML;
};


getUsers().then((data) => {
    console.log(data);
});



DisplayUsers();


if (btnUser) {
    btnUser.addEventListener("click", () => {
        productList.innerHTML = "";
        userList.innerHTML = "";
        DisplayUsers();
    });
}
