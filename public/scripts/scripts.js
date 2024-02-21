// Not Empty: true


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


const editUser = async (userId) => {
    console.log(userId);
    const response = await fetch(`/my-little-mvc/admin/users/edit/${userId}`,{method:'POST'});
        const data = await response.json();
        /*if(data === "success"){*/
        DisplayUsers();
        /*}*/
}

const DisplayUsers = async () => {
  const users = await getUsers();
  let usersHTML = "<table><tr><th>Name</th><th>Email</th><th>Role</th><th>Actions</th></tr>";

  users.forEach(user => {
    usersHTML += `<tr>
                    <td><input id="fullname-${user.id}"  value="${user.id}"></td>
                    <td><input id="fullname-${user.id}" name="fullname" value="${user.fullname}"></td>
                    <td><input id="email-${user.id}" name="email" value="${user.email}"></td>
                    <td>
                      <button onclick="editUser('${user.id}')">Edit</button>
                      <button onclick="deleteUser('${user.id}')">Delete</button>
                    </td>
                  </tr>`;
  });

  usersHTML += "</table>";
  document.getElementById("test").innerHTML = usersHTML;
}


DisplayUsers();

getUsers().then((data) => {
  console.log(data);
});


getProduct().then((data) => {
  console.log(data);
});
