#!/bin/bash

# Скрипт для синхронизации всех веток Git с удалённым репозиторием

# Проверяем, является ли текущая директория Git-репозиторием
if ! git rev-parse --is-inside-work-tree > /dev/null 2>&1; then
    echo "Ошибка: это не Git-репозиторий."
    exit 1
fi

# Получаем последние изменения с удалённого репозитория
echo "Получаем информацию об удалённых ветках..."
git fetch --all --prune

# Получаем список всех локальных веток
LOCAL_BRANCHES=$(git branch | sed 's/^\*//' | sed 's/^ *//')

# Синхронизируем каждую локальную ветку
for branch in $LOCAL_BRANCHES; do
    # Проверяем, существует ли удалённая ветка
    if git show-ref --verify --quiet "refs/remotes/origin/$branch"; then
        echo "Синхронизация ветки $branch..."
        git checkout "$branch"

         git pull origin "$branch"

    else
        echo "Удалённая ветка origin/$branch не существует, пропускаем..."
    fi
done

# Синхронизируем все отслеживаемые ветки
echo "Синхронизация всех отслеживаемых веток..."
git pull --all

echo "Синхронизация завершена."