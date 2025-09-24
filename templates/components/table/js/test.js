const { createApp, ref } = Vue;

// Компонент списка задач
const TodoList = {
    props: ['todos'],
    template: `
                <div>
                    <h3>Список задач:</h3>
                    <ul>
                        <li v-for="(todo, index) in todos" :key="index">
                            {{ todo }}
                            <button @click="$emit('remove-todo', index)" class="btn">×</button>
                        </li>
                    </ul>
                </div>
            `
};

// Компонент добавления задачи
const AddTodo = {
    emits: ['add-todo'],
    data() {
        return {
            newTodo: ''
        };
    },
    template: `
                <div>
                    <input v-model="newTodo" placeholder="Новая задача">
                    <button @click="addTodo" class="btn">Добавить</button>
                </div>
            `,
    methods: {
        addTodo() {
            if (this.newTodo.trim()) {
                this.$emit('add-todo', this.newTodo);
                this.newTodo = '';
            }
        }
    }
};

const app = createApp({
    setup() {
        const title = ref('Менеджер задач на Vue 3');
        const todos = ref(['Изучить Vue 3', 'Создать приложение', 'Тестировать']);

        function addTodo(todo) {
            todos.value.push(todo);
        }

        function removeTodo(index) {
            todos.value.splice(index, 1);
        }

        return {
            title,
            todos,
            addTodo,
            removeTodo
        };
    }
});

// Регистрируем компоненты
app.component('todo-list', TodoList);
app.component('add-todo', AddTodo);

app.mount('#app');