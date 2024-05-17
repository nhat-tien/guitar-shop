export const API_ROOT = process.env.NEXT_PUBLIC_BACKEND_URL

export const API = {
	CSRF: API_ROOT + '/sanctum/csrf-cookie',
	AUTH: {
		LOGIN: API_ROOT + '/login',
		REGISTER: API_ROOT + '/register',
	}
}
