// работет только в браузере, NodeJS не поддерживает метод Fetch!

const test = async (value) => {
    const getDefaultHeaders = (JWTToken) => {
        return new Headers({
            Accept: 'application/json',
            Authorization: "Bearer " + JWTToken
        });
    };

    const base = 'http://localhost:8000/api';

    let token;

    const email = `test${value}@mail.ru`;
    const name = `test${value}`;
    const password = '123123qwe';

    await fetch(base + `/auth/registration?name=${name}&password=${password}&email=${email}`, {
        method: 'POST',
        headers: new Headers({
            Accept: 'application/json'
        }),
    }).then(x => x.json()).then(x => {
        console.log(x)
    });


    await fetch(base + '/auth/login', {
        method: 'POST',
        headers: new Headers({
            Accept: 'application/json'
        }),
        body: JSON.stringify({
            email,
            password
        })
    }).then(x => x.json()).then(x => {
        token = x['access_token']
    });

    await fetch(base + '/developers', {
        method: 'GET',
        headers: getDefaultHeaders(token),
    }).then(x => x.json()).then(x => {
        console.log(x)
    });

    await fetch(base + '/courses', {
        method: 'GET',
        headers: getDefaultHeaders(token),
    }).then(x => x.json()).then(x => {
        console.log(x)
    });

    await fetch(base + '/it_types', {
        method: 'GET',
        headers: getDefaultHeaders(token),
    }).then(x => x.json()).then(x => {
        console.log(x)
    });
}
