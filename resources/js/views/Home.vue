<template>
  <div>
    <div class="mb-4">
      <input
        type="text"
        v-model="search"
        @change="fetchGithubUsers"
        class="border-indigo-700 block w-full"
        placeholder="Search"
      />
    </div>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
          <div
            class="
              shadow
              overflow-hidden
              border-b border-gray-200
              sm:rounded-lg
            "
          >
            <div
              v-if="users && users.items && users.items.length > 0"
              class="grid grid-cols-2 gap-4"
            >
              <div v-for="(user, key) in users.items" :key="key">
                <figure class="md:flex bg-gray-100 rounded-xl p-8 md:p-0">
                  <img
                    class="
                      w-32
                      h-32
                      md:w-48
                      md:h-auto
                      md:rounded-none
                      rounded-full
                      mx-auto
                    "
                    :src="user.avatar_url"
                    alt=""
                    width="384"
                    height="512"
                  />
                  <div class="pt-6 md:p-8 text-center md:text-left space-y-4">
                    <figcaption class="font-medium">
                      <router-link :to="`/profile/${user.login}`">{{
                        user.login
                      }}</router-link>
                      <div class="text-gray-500">
                        <span>Type: </span>
                        <span>{{ user.type }}</span>
                      </div>
                      <div class="text-gray-500">
                        <span>Score: </span>
                        <span>{{ user.score }}</span>
                      </div>
                    </figcaption>
                  </div>
                </figure>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      search: "",
      users: null,
    };
  },
  methods: {
    fetchGithubUsers: async function () {
      const { data } = await axios.get("/api/search/?q=" + this.search);
      if (data) {
        this.users = data;
      }
    },
  },
};
</script>