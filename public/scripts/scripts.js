// Not Empty: true

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

const DisplayUsers = async () => {
  const users = await getUsers();
  let usersHTML = "<table><tr><th>Name</th><th>Email</th><th>Role</th><th>Actions</th></tr>";
  usersHTML.innerHTML = "";
  users.forEach(user => {
    usersHTML += `<tr>
                    <td>${user.id}</td>
                    <td>${user.fullname}</td>
                    <td>${user.email}</td>
                    <td>${user.role}</td>
                    <td>
                      <button onclick="editUser('${user.id}')">Edit</button>
                      <button onclick="deleteUser('${user.id}')">Delete</button>
                    </td>
                  </tr>`;
  });

  usersHTML += "</table>";
  document.getElementById("test").innerHTML = usersHTML;
}

deleteUser();

DisplayUsers();

getUsers().then((data) => {
  console.log(data);
});


getProduct().then((data) => {
  console.log(data);
});
