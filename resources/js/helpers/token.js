class Token {

    isValid(token) {
        const payload = this.payload(token)
        console.log(payload);
        if (payload) {
            const baseURL = window.location.origin;
            return payload.iss == `${baseURL}/api/auth/login` || `${baseURL}/api/auth/register` ? true : false
        }
        return false
    }


    payload(token){
        const payload=token.split('.')[1]//picking second string from the token
        return this.decode(payload)

    }

    decode(payload){
        return JSON.parse(atob(payload))//decode a base64-encoded string into a binary data
    }

}

export default Token = new Token();