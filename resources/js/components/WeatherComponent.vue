<template>
  <div class="w-3/5 m-auto overflow-hidden">
    <div class="w-full mt-2 mb-2 text-4xl">Enter a city name..</div>
    <div class="w-full mt-2 mb-2 shadow-lg">
      <input type="search" id="address" class="form-control" placeholder="Search for a city.." />
    </div>
    <div
      class="w-full bg-gray-900 p-2 text-white font-semibold"
    >{{formattedDate}}, {{formattedDate}}</div>
    <div class="w-full bg-gray-800 text-white">
      <div class="flex items-center justify-between px-6 py-8">
        <div class="text-6xl font-semibold">
          <div class="flex">
            <div>
              <img v-bind:src="this.temperatureData.icon" />
            </div>
            <div>
              {{temperatureData.temp}}
              <span>&#176;</span> c
            </div>
          </div>
        </div>
        <div class="text-2xl">
          <i class="fas fa-map-marker-alt mr-2"></i>
          {{location.name}}
        </div>
      </div>
      <div class="px-6 py-8">
        Min. temp:
        <span class="font-semibold">{{temperatureData.min}}</span>,
        max. temp:
        <span class="font-semibold">{{temperatureData.max}}</span>
        <p>
          Humidity:
          <span class="font-semibold">{{temperatureData.humidity}} %</span>
        </p>
        <p>{{temperatureData.wind}} m/s</p>
        <p>{{temperatureData.description}}</p>
      </div>
    </div>
    <div class="w-full mt-2">
      <iframe v-bind:src="this.location.url" width="1000" height="450" frameborder="0"></iframe>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    this.fetchCurrentWeather();
    const placesAutocomplete = places({
      appId: 'plL13MNFDUIT',
      apiKey: '5101bdd9f73d62f6817d0d9cca19f3f2',
      container: document.querySelector('#address')
    }).configure({
      type: 'city',
      aroundLatLngViaIP: false
    });
    placesAutocomplete.on('change', e => {
      this.location.name = `${e.suggestion.name}, ${e.suggestion.country}`;
      this.location.lat = e.suggestion.latlng.lat;
      this.location.lng = e.suggestion.latlng.lng;
    });
  },
  watch: {
    location: {
      handler(newValue, oldValue) {
        this.fetchCurrentWeather();
      },
      deep: true
    }
  },
  data() {
    return {
      temperatureData: {
        temp: '',
        min: '',
        max: '',
        humidity: '',
        wind: '',
        description: '',
        icon: ''
      },
      location: {
        name: 'Gothenburg, Sweden',
        lat: 57.70887,
        lng: 11.97456,
        url: ''
      }
    };
  },
  computed: {
    formattedDay() {
      return moment(this.givenDate).format('dddd');
    },
    formattedDate() {
      return moment(this.givenDate).format('MMMM Do YYYY');
    }
  },
  methods: {
    fetchCurrentWeather() {
      fetch(`/api/weather?lat=${this.location.lat}&lng=${this.location.lng}`)
        .then(response => response.json())
        .then(data => {
          this.temperatureData.name = data.name;
          this.temperatureData.temp = Math.round(data.main.temp);
          this.temperatureData.min = Math.round(data.main.temp_min);
          this.temperatureData.max = Math.round(data.main.temp_max);
          this.temperatureData.humidity = data.main.humidity;
          this.temperatureData.wind = data.wind.speed;
          this.temperatureData.description = data.weather[0].main;
          this.temperatureData.icon =
            'http://openweathermap.org/img/wn/' +
            data.weather[0].icon +
            '@2x.png';
          this.location.url =
            'https://embed.windy.com/embed2.html?lat=' +
            this.location.lat +
            '&lon=' +
            this.location.lng +
            '&zoom=5&level=surface&overlay=temp&menu=&message=&marker=&calendar=&pressure=&type=map&location=coordinates&detail=&detailLat=57.647&detailLon=11.929&metricWind=default&metricTemp=default&radarRange=-1';
        });
    }
  }
};
</script>
