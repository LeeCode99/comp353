<!-- SELECT Employee.First_name, Employee.Last_name, InfectedOf.Date_of_Infection, Facilities.Name
FROM Employees AS Employee
JOIN InfectedOf ON Employee.EmployeeID = InfectedOf.EmployeeID
JOIN Work_at ON Employee.EmployeeID = Work_at.EmployeeID
JOIN Facilities ON Work_at.Facility_ID = Facilities.Facility_ID
JOIN DegreeOf ON Employee.EmployeeID = DegreeOf.EmployeeID
JOIN Roles ON DegreeOf.RoleID = Roles.RoleID
WHERE Roles.Role_Description = 'Doctor' AND InfectedOf.Date_of_Infection >= DATE_SUB(NOW(), INTERVAL 14 DAY)
ORDER BY Facilities.Name ASC, Employee.First_name ASC; -->

