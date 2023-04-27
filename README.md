- Create Store Project & Skill
    
    Code ini berasal dari SkillController & Projects Controller Berikut merupakan code yang digunakan pada file tersebut :
    
    ProjectController.php (Source code for Create store for name, image , & project URL)
    public function store(Request $request)
    {
        $request->validate([
            'image'=>['required', 'image'],
            'name'=>['required', 'min:3'],
            'skill_id'=>['required']
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image')->store('projects');
            Project::create([
                'skill_id'=>$request->skill_id,
                'name'=>$request->name,
                'image'=>$image,
                'project_url'=>$request->project_url
            ]);

            return Redirect::route('projects.index');
        }
        return Redirect::back();
    }
 
 SkillController.php. (Source Code For store name, image for skill that used)
 public function store(Request $request)
    {
        $request->validate([
            'image'=>['required', 'image'],
            'name'=>['required', 'min:3']
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image')->store('skills');
            Skill::create([
                'name'=>$request->name,
                'image'=>$image
            ]);

            return Redirect::route('skills.index');
        }
        return Redirect::back(); 
    }
    
    
- Display Skills
  pada display skill tampilan yang digunakan mengambil sumber dari flow bite dengan Source Code dan Link:
  <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Image
                        </th>
                        <th scope="col" class="px-6 py-3">
                            
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="skill in skills.data" :key="skill.id" 
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ skill.id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ skill.name }}
                        </td>
                        <td class="px-6 py-4">
                            <img src="skill.image" />
                        </td>
                        <td class="px-6 py-4">
                            Edit/Delete
                        </td>
                    </tr>
                </tbody>
            </table>

  code diatas diaplikasikan atau dimasukkan pada folder skills dan dimasukkan di file index.vue yang berfungsi untuk sebagai desain ui 
  memperlihatkan data yang tersimpan

  Selanjutnya dibuatnya folder SkillResource yang digunakan sebagai sumber dari data yang tersimpan hal ini juga memakai fungsi file 
  SkillController yang berfungsi sebagai pusat control skill berikut source code :
  
  SkillController (Source Code public function index) 
  public function index()
    {
        $skills = SkillResource::collection(Skill::all());
        return Inertia::render('Skills/index', compact('skills'));
    }
    
    
   SkillResource (Source Code public function toArray(Request $request): array )
   public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => asset('/storage/'.$this->image)
        ];
    }
    
    
    Selanjutnya perlu melakukan Command php artisan storage:link agar semua link tersambung pada storage app public.
    
- Display Projects 
    Pada display projects kurang lebih sama dengan kode pada display skill tetapi ada penambahan pada tampilan yakni ada ID, 
    ada Nama projects , gambar project dan tentunya nanti ditampilkannya link url projects .

    Berikut kode Index.vue yang digunakan untuk menampilkan projects yang disimpan :
    <template>
    <Head title="Projects Index" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Projects</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end m-2 p-2">
                    <Link :href="route('projects.create')" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 text-white rounded-md"> 
                        New Projects
                    </Link>
                </div>
                <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Skill
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Image
                        </th>
                        <th scope="col" class="px-6 py-3">
                            
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="project in projects.data" :key="project.id" 
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ project.id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ project.name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ project.skill.name }}
                        </td>
                        <td class="px-6 py-4">
                            <img :src="project.image" class="w-12 h-12 rounded-full" />
                        </td>
                        <td class="px-6 py-4">
                            Edit/Delete
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
            </div>

        </div>
    </AuthenticatedLayout>
</template>


    Ada juga file ProjectResource yang berfungsi sebagai tempat penyimpanan dari project yang disimpan agar mudah digunakan untuk 
    kegunaan selanjutnya berikut code yang digunakan :
    
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => asset('/storage/'.$this->image),
            'skill'=>new SkillResource($this->whenLoaded('skill')),
            'project_url' =>$this->project_url
        ];
    }
    
    Ada juga file ProjectController yang berfungsi untuk mengkontrol tampilan dari project yang ingin ditampilkan berikut kode yang digunakan :
    public function index()
    {
        $projects = ProjectResource::collection(Project::with('skill')->get());
        return Inertia::render('Projects/index', compact('projects'));
    }
    
-  Edit Skill & Delete

    Pada edit skill dibutuhkannya file edit di dalam folder skills , kemudian   pada file SkillController ditambahkannya public function update 
    dan public function destroy dan pada file index perlunya const props = untuk mendefine skiil menjadi object yang kemudian dibaca oleh controller , 
    dan const submit yang digunakan untuk melakukan edit apakah akan di proses atau tidak.
    
    Berikut Source Code untuk SkillController :
    - Public function update 
      public function update(Request $request, Skill $skill)
    {
        $image = $skill->image;
        $request->validate([
            'name' => ['required', 'min:3']
        ]);
        if ($request->hasFile('image')) {
            Storage::delete($skill->image);
            $image = $request->file('image')->store('skills');
        }

        $skill->update([
            'name' => $request->name,
            'image' => $image
        ]);

        return Redirect::route('skills.index')->with('message', 'Skill updated successfully.');
    }
    
    - Public function Destroy
      public function destroy(Skill $skill)
    {
        Storage::delete($skill->image);
        $skill->delete();

        return Redirect::back();
    }
    
    - file Edit.vue
      <script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head , Link, useForm} from '@inertiajs/vue3';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { Inertia } from "@inertiajs/inertia";

    const props = defineProps({
        skill: Object,
    });

    const form = useForm({
    name: props.skill.name,
    image: null,
});

    const submit = () => {
        Inertia.post(`/skills/${props.skill.id}`, {
        _method: "put",
        name: form.name,
        image: form.image,
        });
    };
</script>
<template>
    <Head title="Edit Skill" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit  Skill</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white">
                <form class="p-4" @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>
            <div class="mt-2">
                <InputLabel for="image" value="Image" />

                <TextInput
                    id="image"
                    type="file"
                    class="mt-1 block w-full"
                    @input="form.image = $event.target.files[0]"
                />

                <InputError class="mt-2" :message="form.errors.image" />
            </div>

            <div class="flex items-center justify-end mt-4">             
                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Update
                </PrimaryButton>
            </div>
        </form> 
            </div>
        </div>
    </AuthenticatedLayout>
</template>


- Edit Project & Delete Project 
    Tidak jauh berbeda dengan yang dilakukan dengan edit skill dan delete skill. Proses yang dilakukan kurang lebih sama. 
    berikut merupakan source code yang digunakan 
      
      - Public Function Update 
        public function update(Request $request, Project $project)
    {
        $image = $project->image;
        $request->validate([
            'name'=>['required', 'min:3'],
            'skill_id'=>['required']
        ]);

        if($request->hasFile('image')){
            Storage::delete($project->image);
            $image = $request->file('image')->store('projects');
        }
        $project->update([
            'name' => $request->name,
            'skill_id' => $request->skill_id,
            'project_url' => $project->project_url,
            'image' => $image
        ]);
        return Redirect::route('projects.index');
    }
    
    
    - Public Function Destroy
    public function destroy(Project $project)
    {
        Storage::delete($project->image);
        $project->delete();
        return Redirect::back()->with('message', 'Project deleted successfully.');
    }
    
    
    - File Edit.vue
    <script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head , Link, useForm} from '@inertiajs/vue3';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { Inertia } from "@inertiajs/inertia";

    const props = defineProps({
        skills: Array,
        project: Object,
    })

    const form = useForm({
    name: props.project.name,
    image: null,
    skill_id: props.project.skill_id,
    project_url: props.project.project_url
});

    const submit = () => {
    Inertia.post(`/projects/${props.project.id}`,{
        _method: "put",
        name: form.name,
        image: form.image,
        skill_id: form.skill_id,
        project_url: form.project_url
    })
};
</script>
<template>
    <Head title="New Projects" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">New Projects</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white">
                <form class="p-4" @submit.prevent="submit">
                <div>
                    <InputLabel for="skill_id" value="Skill" />
                    <select v-model="form.skill_id" id="skill_id" name="skill_id"
                        class="
                        mt-1
                        block
                        w-full
                        pl-3
                        pr-10
                        py-2
                        text-base
                        border-gray-300
                        focus:outline-none focus:ring-indigo-500 focus:border-indigo-500
                        sm:text-sm
                        rounded-md
                        ">
                        <option v-for="skill in skills" :key="skill.id" :value="skill.id">
                            {{ skill.name }}
                        </option>
                    </select>
                </div>
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>
            <div>
                <InputLabel for="project_url" value="URL" />

                <TextInput
                    id="project_url"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.project_url"
                    autocomplete="projecturl"
                />

                <InputError class="mt-2" :message="form.errors.project_url" />
            </div>
            <div class="mt-2">
                <InputLabel for="image" value="Image" />

                <TextInput
                    id="image"
                    type="file"
                    class="mt-1 block w-full"
                    @input="form.image = $event.target.files[0]"
                />

                <InputError class="mt-2" :message="form.errors.image" />
            </div>

            <div class="flex items-center justify-end mt-4">             
                <PrimaryButton class="ml-4" >
                    Update
                </PrimaryButton>
            </div>
        </form> 
            </div>
        </div>
    </AuthenticatedLayout>
</template>
    
    
