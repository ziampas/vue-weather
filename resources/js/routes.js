import WeatherComponent from './components/WeatherComponent';
import ForecastComponent from './components/ForecastComponent';
import PostsComponent from './components/PostsComponent';

export default {
  mode: 'history',
  routes: [{
      path: '/',
      component: WeatherComponent
    }, {
      path: '/forecast',
      component: ForecastComponent
    },
    {
      path: '/posts',
      component: PostsComponent
    }
  ]
}
