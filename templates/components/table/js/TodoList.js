const { createApp, ref } = Vue;
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

export  default TodoList;