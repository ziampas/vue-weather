<template>
  <div class="px-2 mt-2">
    <div class="flex -mx-2">
      <div class="w-4/4 px-2">
        <div class="h-12">
          <div class="w-full bg-gray-900 text-white text-xl font-semibold p-4">Latest news</div>
          <!-- NEWSCARD BEGINS -->
          <div
            v-for="post in posts"
            :key="post.id"
            class="card bg-white shadow-md px-4 py-4 md:px-10 mt-2"
          >
            <h1 class="font-bold text-lg">{{post.title}}</h1>
            <p class="py-4">{{post.body}}</p>
            <div class="flex flex-wrap pt-8">
              <div class="w-full md:w-1/3 text-sm font-medium">Author: {{post.author}}</div>
            </div>
          </div>
          <!-- NEWSCARD ENDS -->
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  mounted() {
    this.fetchPosts();
  },
  data() {
    return {
      posts: null
    };
  },
  methods: {
    fetchPosts() {
      fetch(`/api/posts`)
        .then(response => response.json())
        .then(data => {
          this.posts = data.data;
        });
    }
  }
};
</script>
