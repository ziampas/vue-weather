<template>
  <div class="w-3/5 m-auto overflow-hidden mt-2">
    <div class="w-full mt-2 mb-2 text-4xl">Enter a city name..</div>
    <div class="w-full mt-2 mb-2 shadow-lg">
      <input type="search" id="address" class="form-control" placeholder="Search for a city.." />
    </div>
    <div class="w-full bg-gray-900 text-white font-semibold text-2xl px-4 py-2">
      <i class="far fa-calendar-alt mr-2"></i>
      7 days forecast for {{location.name}}
    </div>
    <div>
      <table class="table-auto w-full">
        <tbody class="bg-gray-800 text-white">
          <tr v-for="day in daily" :key="day.dt">
            <td class="px-4 py-2">{{getWeekDay(day.dt)}}</td>
            <td class="px-4 py-2 font-semibold">{{day.weather[0].main}}</td>
            <td class="px-4 py-2">
              {{getAverageTemp(Math.round(day.temp.min) + Math.round(day.temp.max))}}
              <span>&#176;</span> c
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
export default {
  mounted() {
    this.fetchForecast();
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
        this.fetchForecast();
      },
      deep: true
    }
  },
  data() {
    return {
      daily: [],
      location: {
        name: 'Gothenburg, Sweden',
        lat: 57.70887,
        lng: 11.97456
      }
    };
  },
  methods: {
    fetchForecast() {
      fetch(`/api/forecast?lat=${this.location.lat}&lng=${this.location.lng}`)
        .then(response => response.json())
        .then(data => {
          this.daily = data.daily;
        });
    },
    getWeekDay(timestamp) {
      const time = timestamp * 1000;
      const date = new Date(time);
      const weekdays = [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday'
      ];
      return weekdays[date.getDay()];
    },
    getAverageTemp(minMax) {
      const avg = minMax / 2;
      return avg;
    }
  }
};
</script>
