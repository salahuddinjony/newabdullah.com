---
author: ["Abdullah Al Mamun"]
title: "AI Agent with MCP: Smart Meeting Scheduler"
date: 2025-04-11
comments: true
draft: false
tags:
  [
    "AI agent",
    "MCP",
    "calendar automation",
    "gmail automation",
    "LLM commands",
    "OpenAI",
    "Google Calendar API",
    "Gmail API",
  ]
categories: ["AI Projects"]
---



## Context: Why This Project Matters, Who It’s For, and What You’ll Learn

In this post, I’m excited to share a recent development—an AI agent powered by the Model Context Protocol (MCP), OpenAI, and Google APIs that can set up meetings on your calendar and send notification emails, all triggered by simple natural language commands. This project is designed for developers, tech enthusiasts, and productivity geeks who want to explore the power of LLMs in real-world task automation.

You'll learn how an AI agent can understand contextual prompts and use structured protocols like MCP to call APIs for practical outcomes—like scheduling a meeting or notifying participants via Gmail. If you're interested in automating workflows with natural language interfaces, this is for you.

## Background: What Inspired This Project

The idea came from a common frustration—having to juggle between chat, calendars, and emails just to organize one meeting. So I built a smart AI agent that interprets my intent using OpenAI's LLM, and then takes real-world actions using:

- **Google Calendar API** to schedule meetings.
- **Gmail API** to send emails.
- **MCP (Model Context Protocol)** to structure and manage context-aware tasks reliably.

```python
import os
import sys
import time
from openai import OpenAI, RateLimitError
from dotenv import load_dotenv
from typing import Optional
import backoff

# Load environment variables
sys.path.append(os.path.dirname(os.path.dirname(os.path.abspath(__file__))))
load_dotenv()

# Constants
THREAD_ID_FILE = "thread_id.txt"
MODEL_NAME = "gpt-4-turbo"
MAX_RETRIES = 3
INITIAL_RETRY_DELAY = 2
MAX_RETRY_DELAY = 60

class AssistantManager:
    def __init__(self):
        # Initialize API key and OpenAI client
        self.api_key = os.getenv("OPENAI_API_KEY")
        self.client = OpenAI(api_key=self.api_key, timeout=60.0, max_retries=5)
        
        # Test API connection with retries
        self.test_api_connection()

        # Load assistant configuration
        self.assistant_id = os.getenv("ASSISTANT_ID")
        self.load_or_create_assistant()

        # Load thread ID
        self.thread_id = self.load_thread_id()

    def test_api_connection(self):
        # Retry connection if rate limit error occurs
        retry_count = 0
        while retry_count < MAX_RETRIES:
            try:
                models = self.client.models.list()
                break
            except RateLimitError as e:
                retry_count += 1
                time.sleep(min(INITIAL_RETRY_DELAY * (2 ** retry_count), MAX_RETRY_DELAY))

    def load_or_create_assistant(self):
        try:
            self.assistant = self.client.beta.assistants.retrieve(self.assistant_id)
        except Exception:
            self.create_new_assistant()

    def create_new_assistant(self):
        # Create a new assistant if not found
        self.assistant = self.client.beta.assistants.create(
            name="Email Assistant",
            instructions="Assistant instructions",
            model=MODEL_NAME
        )
        self.assistant_id = self.assistant.id

    def load_thread_id(self) -> Optional[str]:
        # Load thread ID from file
        if os.path.exists(THREAD_ID_FILE):
            with open(THREAD_ID_FILE, "r") as file:
                return file.read().strip()
        return None

    def save_thread_id(self, thread_id: str) -> None:
        # Save thread ID to file
        with open(THREAD_ID_FILE, "w") as file:
            file.write(thread_id)

    def process_user_input(self, user_input: str) -> bool:
        # Process user input, reset thread or quit
        if user_input.lower() == "reset":
            self.reset_thread()
            return True
        elif user_input.lower() == "quit":
            print("Goodbye.")
            return False
        # Handle conversation logic
        return True

    def reset_thread(self) -> None:
        # Reset the conversation thread
        self.thread_id = None
        if os.path.exists(THREAD_ID_FILE):
            os.remove(THREAD_ID_FILE)

    def run(self) -> None:
        # Main conversation loop
        while True:
            user_input = input("Enter your message: ")
            if not self.process_user_input(user_input):
                break

if __name__ == "__main__":
    assistant_manager = AssistantManager()
    assistant_manager.run()


```

## How It Works: Behind the Scenes

The agent listens to a single instruction like:  
**“Schedule a meeting with Mamun on Monday at 3 PM about the RecSys project and send him a confirmation email.”**

And it performs the following steps:

1. **Parses the command** using OpenAI LLM.
2. **Creates an MCP request** to store the user’s intent and current context.
3. **Calls the Google Calendar API** to create a new event.
4. **Uses the Gmail API** to send a formatted email with meeting details.

The key here is **context tracking with MCP**. It ensures the agent understands who is involved, when the meeting should occur, and what it’s about—even if I just say, “Book it like the last one, but with Sara.”

## Key Components & Technologies

- **OpenAI GPT-4**: For command parsing and decision-making.
- **MCP (Model Context Protocol)**: For structuring AI-agent memory and task execution.
- **Google Calendar API**: For event creation and modification.
- **Gmail API**: For sending meeting emails.
- **Python & Flask**: As the glue to orchestrate LLM output and API calls.

## Future Scope

- Add voice command support.
- Allow recurring meetings and conflict resolution.
- Integrate Slack or WhatsApp bot support for command input.

## Final Thoughts

This agent proves how AI isn’t just about chat—it’s about action. With just one sentence, I can automate multiple backend operations, making daily workflows faster and smarter. I’ll be sharing the full code soon. Feel free to connect if you want to build one yourself!
