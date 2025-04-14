using System;
using System.Collections.Generic;
using System.IO;
using System.Text.RegularExpressions;
using Newtonsoft.Json;

namespace Students
{
    public class StudentManager
    {
        private readonly string filePath = Path.Combine(AppDomain.CurrentDomain.BaseDirectory, "students.json");

        public List<Student> LoadStudents()
        {
            if (File.Exists(filePath))
            {
                string json = File.ReadAllText(filePath);
                return JsonConvert.DeserializeObject<List<Student>>(json);
            }
            return new List<Student>();
        }

        public void SaveStudents(List<Student> students)
        {
            string json = JsonConvert.SerializeObject(students, Formatting.Indented);
            File.WriteAllText(filePath, json);
        }

        public int GetNextId(List<Student> students)
        {
            int maxId = 0;
            foreach (var student in students)
            {
                if (student.Id > maxId)
                {
                    maxId = student.Id;
                }
            }
            return maxId + 1;
        }

        public bool IsValidBirthDate(string birthDate)
        {
            if (DateTime.TryParseExact(birthDate, "dd.MM.yyyy", null, System.Globalization.DateTimeStyles.None, out DateTime parsedDate))
            {
                DateTime minDate = new DateTime(1992, 1, 1);
                DateTime maxDate = DateTime.Today;
                return parsedDate >= minDate && parsedDate <= maxDate;
            }
            return false;
        }

        public bool IsValidEmail(string email)
        {
            string pattern = @"^[a-zA-Z0-9._%+-]{3,}@(gmail\.com|yandex\.com|icloud\.com)$";
            return Regex.IsMatch(email, pattern);
        }

        public bool AreStudentsEqual(List<Student> list1, List<Student> list2)
        {
            if (list1.Count != list2.Count)
                return false;

            for (int i = 0; i < list1.Count; i++)
            {
                if (!list1[i].Equals(list2[i]))
                    return false;
            }

            return true;
        }
    }
}
