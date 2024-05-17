'use client'

import { zodResolver } from "@hookform/resolvers/zod";
import { useForm } from "react-hook-form";
import * as z from "zod"
import { Form, FormControl, FormField, FormItem, FormLabel, FormMessage } from "@/components/ui/form";
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";

const formSchema = z.object({
	username: z.string().min(2).max(50),
	email: z.string().email(),
	password: z.string().min(6),
	confirmpassword: z.string().min(6),
}).refine((data) => data.password == data.confirmpassword, {
	message: "Password don't match",
	path: ["confirmpassword"],
});

export default function RegisterForm() {


	const form = useForm<z.infer<typeof formSchema>>({
		resolver: zodResolver(formSchema),
		defaultValues: {
			username: "",
			email: "",
			password: "",
			confirmpassword: "",
		}
	});

	function onSubmit(values: z.infer<typeof formSchema>) {
		console.log(values);
	}


	return (
		<Form {...form}>
			<form onSubmit={form.handleSubmit(onSubmit)}>
				<FormField
					control={form.control}
					name="username"
					render={({field}) => (
						<FormItem>
							<FormLabel>
								User name
							</FormLabel>
							<FormControl>
								<Input placeholder="username" {...field}/>
							</FormControl>
							<FormMessage />
						</FormItem>
					)}
				/>
				<FormField
					control={form.control}
					name="email"
					render={({field}) => (
						<FormItem>
							<FormLabel>
								Email
							</FormLabel>
							<FormControl>
								<Input placeholder="email" {...field}/>
							</FormControl>
							<FormMessage />
						</FormItem>
					)}
				/>
				<FormField
					control={form.control}
					name="password"
					render={({field}) => (
						<FormItem>
							<FormLabel>
								Password
							</FormLabel>
							<FormControl>
								<Input placeholder="password" {...field}/>
							</FormControl>
							<FormMessage />
						</FormItem>
					)}
				/>
				<FormField
					control={form.control}
					name="confirmpassword"
					render={({field}) => (
						<FormItem>
							<FormLabel>
								Confirm password
							</FormLabel>
							<FormControl>
								<Input placeholder="confirmpassword" {...field}/>
							</FormControl>
							<FormMessage />
						</FormItem>
					)}
				/><Button type="submit">Submit</Button>
			</form>
		</Form>
	) 
};

