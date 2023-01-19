var users = [];
var userID;
const url = '../../backend/api/users.php';
function getUsers(){
    axios({
        method:'GET',
        url: url,
        responseType:'json',
    }).then(res=>{
        console.log(res.data);
        this.users = res.data;
        fillTable();
    }).catch(error=>{
        console.error(error);
    });
}
getUsers();

function fillTable(){
    document.querySelector('#users-table tbody').innerHTML = '';
    for (let i=0; i<users.length; i++){
        document.querySelector('#users-table tbody').innerHTML +=
        `<tr>
            <td>${users[i].name}</td>
            <td>${users[i].lastName}</td>
            <td>${users[i].birthday}</td>
            <td>${users[i].country}</td>
            <td><button type="button" onclick="select(${i})">Y</button></td>
            <td><button type="button" onclick="deleteUser(${i})">X</button></td>
        <tr>`;
    }
    
}

function deleteUser(id){
    console.log('Delete element with id ' + id);
    axios({
        method:'DELETE',
        url: url + `?id=${id}`,
        responseType:'json',
    }).then(res=>{
        console.log(res.data);
        getUsers();
    }).catch(error=>{
        console.error(error);
    });
}

function save(){
    document.getElementById('btn-save').disable = true;
    document.getElementById('btn-save').innerHTML = 'Saving...';
    let user = {
        name: document.getElementById('name').value,
        lastName: document.getElementById('lastName').value,
        birthday: document.getElementById('birthday').value,
        country: document.getElementById('country').value
    };
    console.log('user to save', user);
    axios({
        method:'POST',
        url: url,
        responseType:'json',
        data: user
    }).then(res=>{
        console.log(res.data);
        reset();
        getUsers();
        document.getElementById('btn-save').disable = false;
        document.getElementById('btn-save').innerHTML = 'Save';
    }).catch(error=>{
        console.error(error);
    });
}

function reset(){
    document.getElementById('name').value=null;
    document.getElementById('lastName').value=null;
    document.getElementById('birthday').value=null;
    document.getElementById('country').value=null;
    document.getElementById('btn-save').style.display = 'inline';
    document.getElementById('btn-update').style.display = 'none';
}

function update() {
    document.getElementById('btn-update').disable = true;
    document.getElementById('btn-update').innerHTML = 'Updating...';
    let user = {
        name: document.getElementById('name').value,
        lastName: document.getElementById('lastName').value,
        birthday: document.getElementById('birthday').value,
        country: document.getElementById('country').value
    };
    console.log('user to update', user);
    axios({
        method:'PUT',
        url: url + `?id=${userID}`,
        responseType:'json',
        data: user
    }).then(res=>{
        console.log(res);
        reset();
        getUsers();
    }).catch(error=>{
        console.error(error);
    });
}

function select(id) {
    userID = id;
    console.log('you select the element: ' + id);
    axios({
        method:'GET',
        url: url + `?id=${id}`,
        responseType:'json',
    }).then(res=>{
        console.log(res);
        document.getElementById('name').value=res.data.name;
        document.getElementById('lastName').value=res.data.lastName;
        document.getElementById('birthday').value=res.data.birthday;
        document.getElementById('country').value=res.data.country;
        document.getElementById('btn-save').style.display = 'none';
        document.getElementById('btn-update').style.display = 'inline';
    }).catch(error=>{
        console.error(error);
    });
}