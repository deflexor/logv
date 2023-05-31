<template>
    <div>
      <h1>Login</h1>
      <form @submit.prevent="login">
        <div>
          <label for="email">Email:</label>
          <input type="email" id="email" v-model="email" required />
        </div>
        <div>
          <label for="password">Password:</label>
          <input type="password" id="password" v-model="password" required />
        </div>
        <button type="submit">Login</button>
      </form>
      <div v-if="error">{{ error }}</div>
    </div>
  </template>
  
  <script lang="ts">

  import { navigateTo } from '../router';
    
  export default {
    data() {
      return {
        email: '',
        password: '',
        error: '',
      };
    },
    methods: {
      async login() {
        try {
          const response = await fetch('/api/login', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify({
              email: this.email,
              password: this.password,
            }),
          });
  
          if (response.ok) {
            const data = await response.json();
            // Save the JWT token in local storage or a secure cookie
            localStorage.setItem('token', data.token);
  
            // Redirect to the authenticated route
            navigateTo('/logs');
          } else {
            throw new Error('Invalid credentials');
          }
        } catch (error) {
          alert(String(error))
        }
      },
    },
  };
  </script>
  