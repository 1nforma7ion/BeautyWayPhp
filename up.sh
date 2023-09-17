#!/bin/bash
echo "********* Status ****************"
git status
sleep 2

echo "********* add ****************"
git add .
sleep 2

echo "********* commit ****************"
read -p "Escribir Commit -> " COMMENT
git commit -m "$COMMENT" 

echo "********* Push ****************"
git push
echo "********* Finalizado ****************"
