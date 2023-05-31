
import { ComponentPublicInstance } from 'vue';


import Home from './components/Home.vue'
import LogViewer from './components/LogViewer.vue'
import JWTAuth from './components/JWTAuth.vue'
import NotFound from './components/NotFound.vue'
import { createApp } from 'vue';

let instance: ComponentPublicInstance<{ prop: string }, { value: string }>;

export const routes: Map<string, instance> = {
    '/': Home,
    '/logs': LogViewer,
    '/login': JWTAuth,
  };
  
  export function navigateTo(path: string | URL | null | undefined) {
    history.pushState({}, '', path);
    handleRouteChange();
  }
  
  function handleRouteChange() {
    const currentPath = window.location.pathname;
    const component = routes[currentPath];
  
    if (component) {
      createApp(component).mount('#app');
    } else {
      createApp(NotFound).mount('#app');
    }
  }
  
  window.addEventListener('popstate', handleRouteChange);
  