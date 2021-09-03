<template>
  <div>
    <div v-if="user" class="flex">
      <figure class="md:flex w-4/12 mr-4 flex-col bg-gray-100 rounded-xl p-2">
        <img
          class="w-55 h-55 rounded-full mx-auto"
          :src="user.avatar_url"
          alt=""
          width="384"
          height="512"
        />
        <div class="pt-6 p-2 text-center md:text-left space-y-4">
          <blockquote>
            <h1 class="font-bold mb-0 text-3xl">{{ user.name }}</h1>
            <p class="text-gray-700 !mt-0 text-xl">{{ user.login }}</p>
          </blockquote>
          <blockquote>
            <p class="text-lg font-semibold">“{{ user.bio }}”</p>
          </blockquote>
          <figcaption class="font-medium">
            <div class="text-cyan-600">{{ user.company }}</div>
            <div class="text-gray-500">{{ user.location }}</div>
          </figcaption>
        </div>
      </figure>
      <div class="flex-1 bg-gray-100 p-4 rounded-xl">
        <div v-if="user.repos && user.repos.length > 0">
          <div
            class="mb-4 p-4 bg-white shadow-lg rounded-xl"
            v-for="(repo, key) in user.repos"
            :key="key"
          >
            <h1 class="text-indigo-700 flex justify-between">
              <a class="text-2xl" :href="repo.html_url" target="_blank">{{
                repo.name
              }}</a>
              <span class="border !border-gray-200 px-3 py-2 rounded-md">{{
                repo.private ? "Private" : "Public"
              }}</span>
            </h1>
            <p>
              <span>{{ repo.full_name }}</span>
              <span>{{ repo.language }}</span>
            </p>
          </div>
        </div>
      </div>
    </div>
    <div v-else class="flex absolute left-0 top-0 items-center justify-center h-screen w-screen">
      <div class="relative h-8 w-8">
        <span
          class="
            animate-ping
            absolute
            inline-flex
            h-full
            w-full
            rounded-full
            bg-purple-400
            opacity-75
          "
        ></span>
        <span
          class="relative inline-flex rounded-full h-8 w-8 bg-purple-500"
        ></span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      user: null,
    };
  },
  methods: {
    fetchUserInfo: async function (name) {
      const { data } = await axios.get(`/api/users/${name}`);
      if (data) {
        this.user = data;
      }
    },
  },
  created: function () {
    let pathArray = window.location.pathname.split("/");
    this.fetchUserInfo(pathArray[pathArray.length - 1]);
  },
};
</script>