#!/usr/bin/env bash

session="mvc"

tmux start-server
tmux new-session -d -s $session

tmux selectp -t 1
tmux send-keys "cd bjtob17/mvc/ && docker-compose up db" C-m

tmux splitw -h -p 50
tmux send-keys "~/scripts/serve-php.sh" C-m

tmux new-window -t $session:1

tmux attach-session -t $session
