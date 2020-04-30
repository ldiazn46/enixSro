USE [SRO_VT_ACCOUNT]
GO

/****** Object:  Table [dbo].[websro_epin_history]    Script Date: 05/17/2013 19:53:46 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[websro_epin_history](
	[Code] [varchar](50) NOT NULL,
	[Value] [varchar](20) NOT NULL,
	[Type] [varchar](10) NOT NULL,
	[UserID] [varchar](50) NOT NULL,
	[Date] [datetime] NOT NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


