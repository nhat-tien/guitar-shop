import { API } from "@/utils/api/config"

type LoginParams = {
	email: string,
	password: string,
}

type RegisterParams = {
	email: string,
	password: string,
}

async function csrf() {
	try {
		await fetch(API.CSRF, {
			method: "GET",
			credentials: 'include'
		});
	} catch(error) {
		console.log(error)
	}
}

async function login({ email, password }: LoginParams) {
}

async function register({email, password}: RegisterParams) {
	
}
